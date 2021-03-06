
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CreateComponent } from './components/events/create/create.component';
import { MainComponent } from './components/events/main/main.component';
import { InicioComponent } from './components/inicio/inicio.component';
import { LoginComponent } from './components/login/login.component';
import { RegistrarseComponent } from './components/registrarse/registrarse.component';
import {ProducerGuard} from './guards/producer.guard';

import { ShoppingCartComponent } from './components/shopping-cart/shopping-cart.component';
import { InicioGuard } from './guards/inicio.guard';
import { CreateProductComponent } from './components/create-product/create-product.component';
import { IniciologComponent } from './components/userLog/iniciolog/iniciolog.component';

const routes: Routes = [
  { path: '',   redirectTo: '/inicio', pathMatch: 'full' },
  { path: 'inicio', component: InicioComponent },
  { path: 'login', component: LoginComponent },
  { path: 'registro', component: RegistrarseComponent },
  { path: 'eventCreate', component: CreateComponent, canActivate:[ProducerGuard] },
  { path: 'eventVer', component: MainComponent,canActivate:[InicioGuard] },
  { path: 'inicioLog', component: IniciologComponent, canActivate:[InicioGuard] },
  { path: 'carrito', component: ShoppingCartComponent,canActivate:[InicioGuard]},
  { path: 'create-product', component: CreateProductComponent},
  { path: 'create-product/:id', component: CreateProductComponent}
 
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
