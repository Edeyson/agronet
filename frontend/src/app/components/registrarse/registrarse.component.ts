import { Component, OnInit } from '@angular/core';
import { CountriesService } from 'src/app/services/countries.service';
import { cities, states } from '../interfaces/interfaces';

@Component({
  selector: 'app-registrarse',
  templateUrl: './registrarse.component.html',
  styleUrls: ['./registrarse.component.scss']
})
export class RegistrarseComponent implements OnInit {

  public countries = [];
  public states!: states[];
  public ciudades!: cities[];

  public country = "CO";
  public selectedStateName = "";
  public statesOfCountry = [];
  constructor(private service: CountriesService) { }

  ngOnInit(): void {
    this.countries = this.service.getAllCountries();
    this.states = this.service.getStatesOfCountry(this.country);
    console.log(this.states);


  }

  public onSite(state:string) {


    this.ciudades = this.service.getCitiesOfState(this.country, state);
    console.log(this.ciudades);



    for (const key of this.statesOfCountry) {
      if (key["isoCode"] === state) {
        this.selectedStateName = key["name"];
        break;
      }
    }
  }


  onSate($event: { target: { value: string; }; }) {
    console.log($event.target.value + " Clicked!");
  }




  departamentoSelected() {
    console.log("department ya fue seleccionado");
    let d =document.getElementById('department');
    console.log(d);
    
  }
}