import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductserviceService } from 'src/app/services/productservice.service';
import { UsuarioserviceService } from 'src/app/services/usuarioservice.service';
import { Product } from '../../interfaces/interfaces';


@Component({
  selector: 'app-productmodal',
  templateUrl: './product-modal.component.html',
  styleUrls: ['./product-modal.component.scss']
})
export class ProductModalComponent implements OnInit {
  

  public product:Product;
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

  constructor(private route: ActivatedRoute, 
    private productService:ProductserviceService,
     private usuarioService:UsuarioserviceService) { 
  }

  ngOnInit(): void {
    this.route.params.subscribe(parametro=>{
      console.log(parametro.id);
      this.productService.getProduct(parametro.id).subscribe(
        resp=>{
          console.log("resp: ",resp);
          this.product = resp.data;
          this.getProducer(this.product.attributes.producer_id);
        }
      );
    });
    
  }

  getProducer(id){
    this.usuarioService.producer(id).subscribe(
      usuario => {
        console.log(usuario.data.attributes);
        this.producer = usuario.data.attributes;
        console.log(this.producer);
        
      }
    );
  }

  // add(index){
  //   this.products[index].cantidad++;
  //   this.getTotal();
  // }

  // sus(index){
  //   if(this.products[index].cantidad>1){
  //     this.products[index].cantidad--;
  //   }else{
      
  //   }
  //   console.log("index",index);
  //   this.getTotal();
    
  // }


}
