import { Component, Input, OnInit } from '@angular/core';
import { CountriesService } from 'src/app/services/countries.service';
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

  constructor( private service: CountriesService) { 
    this.states = this.service.getStatesOfCountry(this.country);
  }

  ngOnInit(): void {
  }

  

}
