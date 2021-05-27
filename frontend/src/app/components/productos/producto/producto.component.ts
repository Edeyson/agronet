import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { CategoriesService } from 'src/app/services/categories.service';
import { ProductserviceService } from 'src/app/services/productservice.service';
import { ShoppingCartService } from 'src/app/services/shopping-cart.service';
import { UsuarioserviceService } from 'src/app/services/usuarioservice.service';
import { Product } from '../../interfaces/interfaces';

@Component({
  selector: 'app-producto',
  templateUrl: './producto.component.html',
  styleUrls: ['./producto.component.scss']
})
export class ProductoComponent implements OnInit {

  @Input() product;
  public codigo:any;

  public producer = {
    apellido: "",
    ciudad: "",
    created_at: "",
    departamento: "",
    email: "",
    nombre: "",
    telefono: "",
    updated_at: ""
  };

  public bandera=false;

  constructor(
    private shoppingCartService: ShoppingCartService,
    public usuarioService: UsuarioserviceService,
    private router: Router,
    private productService: ProductserviceService,
    private toastrService: ToastrService
  ) { }

  ngOnInit(): void {
    console.log("Selected: ",this.product);
    this.getProducer();
    this.getProductsByUser();
  }

  getProducer(){
    this.usuarioService.producer(this.product.attributes.producer_id).subscribe(
      usuario => {
        console.log(usuario.data.attributes);
        this.producer = usuario.data.attributes;
        console.log(this.producer);
        
      }
    );
  }

  addProduct(product: Product)
  {
    this.shoppingCartService.addProduct(product);
  }

  updateProduct(id) {
    this.router.navigate(['create-product/'+id]);
  }
  deleteProduct(id)
  {
    this.productService.delete(id).subscribe(
      res => {
        this.toastrService.success("Borrado correctamente", "Producto");
        this.router.navigate(['/inicio']);
      }
    );
  }

  getProductsByUser(){
    this.productService.getProductsByUser().subscribe(
      resp=>{
        console.log("productos",resp);
        resp.data.forEach(element => {
          console.log("elemto;",element);
          if(element.id==this.product.id){
            this.bandera=true;
          }
        });
      }
    );
  }

}
