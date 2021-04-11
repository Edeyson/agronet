import { Injectable } from '@angular/core';

declare var require: any;
// import csc from 'country-state-city'
const csc = require('country-state-city');
// Import Interfaces`
import { ICountry, IState, ICity } from 'country-state-city'

@Injectable({
  providedIn: 'root'
})
export class CountriesService {

  constructor() { } 

  getAllCountries() {
    const countries = csc.default.getAllCountries();
    return countries;
  }
  getStatesOfCountry(country_id:string) { 
    const states = csc.default.getStatesOfCountry(country_id);
    return states;
  }
  getCitiesOfState(countryCode: string, stateCode:string) {    
    const cities = csc.default.getCitiesOfState(countryCode, stateCode);
    return cities;
  }


  getNameCountry(code:string){
    return csc.default.getCountryByCode(code);
  }
}
