import { Component, OnInit } from '@angular/core';
import { FormControl, FormControlName, FormGroup, Validators } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { CountriesService } from 'src/app/services/countries.service';
import { UsuarioserviceService } from 'src/app/services/usuarioservice.service';
import { cities, PostModel, SingleResponseModel, states, UsuarioI } from '../interfaces/interfaces';

@Component({
  selector: 'app-registrarse',
  templateUrl: './registrarse.component.html',
  styleUrls: ['./registrarse.component.scss']
})
export class RegistrarseComponent implements OnInit {

  public submitted = false;
  public formRegister: FormGroup;
  public usuario: UsuarioI;


  public selectedCountry: any;
  public selectedCountryName: any;
  
  public states!: states[];
  public ciudades!: cities[];

  public country = 'CO';
  public selectedStateName = "";
  public statesOfCountry = [];


  constructor(private service: CountriesService,
              private toastrService: ToastrService, private usuarioService: UsuarioserviceService) { 
                //this.usuarioEnviar = new SingleResponseModel<UsuarioI>();
              }

  ngOnInit(): void {
    this.states = this.service.getStatesOfCountry(this.country);

    this.formRegister = new FormGroup({
      nombre: new FormControl(null, [Validators.required]),
      apellido: new FormControl(null, [Validators.required]),
      email: new FormControl(null, [Validators.required]),
      password: new FormControl(null, [Validators.required]),
      departamento: new FormControl(null, [Validators.required]),
      ciudad: new FormControl(null, [Validators.required]),

      telefono: new FormControl(null, [Validators.required]),
      // direccion: new FormControl(null, [Validators.required]),
      // comentarios: new FormControl(null) 
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
    this.submitted = true;
        
    if (this.formRegister.invalid) {
      this.toastrService.error("Por favor complete todos los campos", "Registro");
      return;
    }

    this.usuario = this.formRegister.value;
    this.usuario.nameToken = "web";
    this.usuario.telefono = this.formRegister.value.telefono+"";
    
    if (this.usuario.password === contrasena.value) {    
      this.toastrService.success("Registro exitoso", "Registro"); 
      console.log(this.usuario);

      let userPost:PostModel= {data:{type:"User",attributes: this.usuario}}

      this.usuarioService.registrar(userPost).subscribe(respuesta =>{
        localStorage.setItem("token",respuesta.token);
        console.log(respuesta);
      });
    } else {
    this.toastrService.warning('Las contraseñas no coinciden', 'Advertencia', {
        timeOut: 5000,
    })
    }
  }
  

  /**
  * validates the form fields
  */
   get f(): any {
    return this.formRegister.controls;
  }
    

}