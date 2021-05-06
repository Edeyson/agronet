import { Injectable } from '@angular/core';
import { Product } from '../components/interfaces/interfaces';

@Injectable({
  providedIn: 'root'
})
export class ShoppingCartService 
{
  public products: Product[] = [];

  constructor() { }

  addProduct(product: Product)
  {
    this.products.push(product);
  }

  removeAllProducts()
  {
    this.products = [];
  }
}
