import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { RegistrarseComponent } from './components/registrarse/registrarse.component';
import { InicioComponent } from './components/inicio/inicio.component';
import { RouterModule, Routes } from '@angular/router';

const rutas: Routes = [
  { path: '',   redirectTo: '/inicio', pathMatch: 'full' },
  { path: 'inicio', component: InicioComponent },
  { path: 'registro', component: RegistrarseComponent },
 
];

@NgModule({
  declarations: [
    AppComponent,
    RegistrarseComponent,
    InicioComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    RouterModule.forRoot(
      rutas,
      { enableTracing: true }
    )
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
