import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ShoppingCartService } from './services/shopping-cart.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'frontend';

  constructor(
    public shoppingCartService: ShoppingCartService,
    private router: Router
  )
  {  }

  goToShoppingCart()
  {
    this.router.navigate(['carrito']);
  }


}
