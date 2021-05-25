import { Injectable } from '@angular/core';
import { Product } from '../components/interfaces/interfaces';

@Injectable({
  providedIn: 'root'
})
export class ShoppingCartService {
  
  public carrito = [];

  constructor() { }

  addProduct(product: Product) {
    let carro = {
      "cantidad":1,
      'type':product.type,
      'id':product.id,
      "attributes":{
        'producer_id':product.attributes.producer_id,
        'category_id':product.attributes.category_id,
        'image_path':product.attributes.image_path,
        'name':product.attributes.name,
        'description':product.attributes.description,
        'measurement':product.attributes.measurement,
        "price":product.attributes.price
      }
    } 
    let esta = false;
    let id = 0;
    for(let i=0;i<this.carrito.length;i++){
      if(product.id==this.carrito[i].id){
        esta = true;
        id=i;
        break
      }
    }
    if(esta){
      this.carrito[id].cantidad++
    }else{
      this.carrito.push(carro);
    }

    
  }

  deleteProduct(id){
    this.carrito = this.carrito.filter(product => product.id != id);    
    return this.carrito;
  }

  getAll(){
    return this.carrito;
  }

  removeAllProducts() {
    this.carrito = [];
  }
  comprar(total:Number){
    console.log("compra: ",this.carrito);
    console.log("total: ",total); 
  }
}
