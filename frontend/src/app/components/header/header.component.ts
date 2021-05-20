import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CountriesService } from 'src/app/services/countries.service';
import { UsuarioserviceService } from 'src/app/services/usuarioservice.service';
import { cities, states } from '../interfaces/interfaces';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  @Input() showHeader = true;

  
  public selectedCountry: any;
  public selectedCountryName: any;
  
  public states!: states[];
  public ciudades!: cities[];

  public country = 'CO';
  public selectedStateName = "";
  public statesOfCountry = [];
  public banderaLogueado = false;

  constructor( private service: CountriesService, 
    private userService: UsuarioserviceService,
    private router:Router){ 
    this.states = this.service.getStatesOfCountry(this.country);
    if(localStorage.getItem('token') && localStorage.getItem('token')!==''){
      this.banderaLogueado = true;
    }else
    {
      this.banderaLogueado = false; 
    }
    
  }

  ngOnInit(): void {
  }
  estadoSeleccinado(estado:string){
    console.log(estado);
    this.ciudades = this.service.getCitiesOfState(this.country,estado);
    console.log(this.ciudades);
}
ciudadSeleccinada(ciudad:string){
console.log(ciudad);

}
public logOut(){
  this.userService.logOut().subscribe(
    logout =>{
      console.log(logout);
      localStorage.clear();
      this.router.navigate(['inicioLog']);
    }
  );
}

}
