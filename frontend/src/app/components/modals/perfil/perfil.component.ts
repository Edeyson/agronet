import { Component, OnInit } from '@angular/core';
import { UsuarioserviceService } from 'src/app/services/usuarioservice.service';

@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.component.html',
  styleUrls: ['./perfil.component.scss']
})
export class PerfilComponent implements OnInit {

  public user = {
    apellido: "",
    ciudad: "",
    created_at: "",
    departamento: "",
    email: "",
    nombre: "",
    telefono: "",
    updated_at: ""
  };

  constructor(
    private usuarioService: UsuarioserviceService
  ) { }

  ngOnInit(): void {
    this.getUser();
  }

  getUser() {
    this.usuarioService.perfil().subscribe(
      usuario => {
        console.log(usuario.data.attributes);
        this.user = usuario.data.attributes;
      }
    );
  }

}
