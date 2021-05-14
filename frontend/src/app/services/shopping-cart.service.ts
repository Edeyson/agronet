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
      "cantidad": 1,
      "producto": {
        'id': product.id,
        'image_url': product.image_url,
        'name': product.name,
        'description': product.description,
        'price': product.price
      }
    }
    let esta = false;
    let id = 0;
    for(let i=0;i<this.carrito.length;i++){
      if(product.id==this.carrito[i].producto.id){
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
    this.carrito = this.carrito.filter(product => product.producto.id != id);    
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
