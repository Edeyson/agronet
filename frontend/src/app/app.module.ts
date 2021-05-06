import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { RegistrarseComponent } from './components/registrarse/registrarse.component';
import { InicioComponent } from './components/inicio/inicio.component';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HeaderComponent } from './components/header/header.component';
import { HttpClientModule } from '@angular/common/http';
import { ProductoComponent } from './components/productos/producto/producto.component';
import { ProductosComponent } from './components/productos/productos/productos.component';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { CommonModule } from '@angular/common';
import { FilterPipe } from './pipes/filter.pipe';
import { LoginComponent } from './components/login/login.component';
import { MaterialModule } from './material/material.module';
import { ProductModalComponent } from './components/modals/product-modal/product-modal.component';
import { ShoppingCartComponent } from './components/shopping-cart/shopping-cart.component';

@NgModule({
  declarations: [
    AppComponent,
    RegistrarseComponent,
    InicioComponent,
    HeaderComponent,
    ProductoComponent,
    ProductosComponent,
    FilterPipe,
    LoginComponent,
    ProductModalComponent,
    ShoppingCartComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    MaterialModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    ToastrModule.forRoot({
      timeOut: 2000,
      progressBar: true,
      progressAnimation: 'increasing',
      preventDuplicates: true,
    }),
    AppRoutingModule
    // RouterModule.forRoot(
    //   rutas,
    //   { enableTracing: true }
    // )
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
