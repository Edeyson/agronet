import { Component, OnInit } from '@angular/core';
import { FormControl, FormControlName, FormGroup, Validators } from '@angular/forms';
import { CountriesService } from 'src/app/services/countries.service';
import { cities, states, UsuarioI } from '../interfaces/interfaces';

@Component({
  selector: 'app-registrarse',
  templateUrl: './registrarse.component.html',
  styleUrls: ['./registrarse.component.scss']
})
export class RegistrarseComponent implements OnInit {

  
  public formRegister: FormGroup;
  public usuario: UsuarioI;

  public selectedCountry: any;
  public selectedCountryName: any;
  
  public states!: states[];
  public ciudades!: cities[];

  public country = 'CO';
  public selectedStateName = "";
  public statesOfCountry = [];


  constructor(private service: CountriesService) { }

  ngOnInit(): void {
    this.states = this.service.getStatesOfCountry(this.country);

    this.formRegister = new FormGroup({
      primerNombre: new FormControl(null, [Validators.required]),
      primerApellido: new FormControl(null, [Validators.required]),
      correo: new FormControl(null, [Validators.required]),
      contrasena: new FormControl(null, [Validators.required]),
      departamento: new FormControl(null, [Validators.required]),
      ciudad: new FormControl(null, [Validators.required]),

      telefono: new FormControl(null, [Validators.required]),
      direccion: new FormControl(null, [Validators.required]),
      comentarios: new FormControl(null, [Validators.required]) 
    })

  }

  public onSate(state: any) {
    let codState = state.target.value;
    this.ciudades = this.service.getCitiesOfState(this.country, codState);
  }


  public onChangeCountry(country: string) {   

    let nameCountry = this.service.getNameCountry(this.selectedCountry)
    this.selectedCountryName = nameCountry.name;
  }

  


  public save(contrasena: HTMLInputElement) {
        
    // if (this.formRegister.invalid) {
    //   return;
    // }

    this.usuario = this.formRegister.value;
    if (this.usuario.contrasena === contrasena.value) {
     console.log(this.usuario);
    } else {
     console.log('Las contraseñas no coinciden', 'Advertencia')
    }
  }
  
    

}