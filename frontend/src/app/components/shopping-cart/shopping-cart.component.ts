import { Component, OnInit } from '@angular/core';
import { ShoppingCartService } from 'src/app/services/shopping-cart.service';

@Component({
  selector: 'app-shopping-cart',
  templateUrl: './shopping-cart.component.html',
  styleUrls: ['./shopping-cart.component.scss']
})
export class ShoppingCartComponent implements OnInit 
{

  public total = 0;

  constructor(
    public shoppingCartService: ShoppingCartService
  ) { }

  ngOnInit(): void {
    this.getTotal();
  }

  getTotal()
  {
    this.total = 0;
    const products = this.shoppingCartService.products;
    products.map((product) => {
      this.total += product.price;
    });
  }

  removeCart()
  {
    this.shoppingCartService.removeAllProducts();
    this.total = 0;
  }

  deleteProduct(id: number)
  {
    const products = this.shoppingCartService.products.filter(product => product.id != id);

    this.shoppingCartService.products = products;
    this.getTotal();
  }

}
