import { Component, OnInit } from '@angular/core';
import { ShoppingCartService } from 'src/app/services/shopping-cart.service';
import { Location } from '@angular/common';

@Component({
  selector: 'app-shopping-cart',
  templateUrl: './shopping-cart.component.html',
  styleUrls: ['./shopping-cart.component.scss']
})
export class ShoppingCartComponent implements OnInit 
{
  public cantidad=1;
  public total = 0;
  public  products = [{
    "cantidad":0,
    'type':"",
    'id':0,
    "attributes":{
      'producer_id':0,
      'category_id':0,
      'image_path':"",
      'name':"",
      'description':"",
      'measurement':0,
      "price":0
    }
  } ];

  constructor(
    public shoppingCartService: ShoppingCartService,
    private location:Location
    
  ) {
    this.products = this.shoppingCartService.getAll();
    console.log(this.products);
    
   }

  ngOnInit(): void {
    this.getTotal();
  }

  getTotal()
  {
    this.total = 0;    
    this.products.map((product) => {      
      this.total += (product.attributes.price*product.cantidad);
    });
  }

  removeCart()
  {
    this.shoppingCartService.removeAllProducts();
    this.total = 0;
    this.products = this.shoppingCartService.getAll();
  }

  deleteProduct(id)
  {
    this.products = this.shoppingCartService.deleteProduct(id);
    this.getTotal();
  }

  back() {
    this.location.back();
  }

  add(index){
    this.products[index].cantidad++;
    this.getTotal();
  }

  sus(index){
    if(this.products[index].cantidad>1){
      this.products[index].cantidad--;
    }else{
      
    }
    console.log("index",index);
    this.getTotal();
    
  }
  comprar(){
    this.shoppingCartService.comprar(this.total);
  }
}
