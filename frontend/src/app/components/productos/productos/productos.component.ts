import { Component, OnInit } from '@angular/core';
import { FormsModule} from '@angular/forms';
import { ProductserviceService } from 'src/app/services/productservice.service';
import { UsuarioserviceService } from 'src/app/services/usuarioservice.service';
import { Product } from '../../interfaces/interfaces';

@Component({
  selector: 'app-productos',
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.scss']
})
export class ProductosComponent implements OnInit 
{
  public products = [];

  public articulos: any;

  public filterProduct = '';

  constructor(private productService: ProductserviceService, private userService: UsuarioserviceService) { 
    // this.loadNews();
  }

  ngOnInit(): void {
    this.loadProducts();
    const token = localStorage.getItem('token');
    if(token)
    {
      this.userService.isAuth = true;
    }
  }

  loadProducts()
  {
    this.productService.getAll().subscribe(
      resp=>{
        console.log(resp.data[0].attributes);
        //this.products = resp.data.attributes;
        resp.data.forEach(element => {
          console.log(element);
          this.products.push(element);
        });
      }
    );
  }

  loadNews(){
    
  }

}
