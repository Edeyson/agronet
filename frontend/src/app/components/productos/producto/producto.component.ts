import { Component, Input, OnInit } from '@angular/core';
import { ShoppingCartService } from 'src/app/services/shopping-cart.service';
import { Product } from '../../interfaces/interfaces';

@Component({
  selector: 'app-producto',
  templateUrl: './producto.component.html',
  styleUrls: ['./producto.component.scss']
})
export class ProductoComponent implements OnInit {

  @Input() product: Product;
  public codigo:any;

  constructor(
    private shoppingCartService: ShoppingCartService
  ) { }

  ngOnInit(): void {
  }

  articuloSelected(){
    console.log("Selected: ",this.product);
  }

  addProduct(product: Product)
  {
    this.shoppingCartService.addProduct(product);
  }

}
