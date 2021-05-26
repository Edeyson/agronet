import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { MapboxService } from 'src/app/services/mapbox.service';
import { UsuarioserviceService } from 'src/app/services/usuarioservice.service';
import { Login } from '../interfaces/login';
import { PostModel } from '../interfaces/post-model';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit 
{
  form: FormGroup;

  constructor(
    private userService: UsuarioserviceService,
    private formBuilder: FormBuilder,
    private toastrService: ToastrService,
    private router: Router,
  ) { }

  ngOnInit(): void
  {
    this.form = this.formBuilder.group({
      email: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  onSubmit(): void
  {
    if (this.form.valid)
    {
      const login: Login = {email: this.f.email.value, password: this.f.password.value, nameToken: 'Web'};
      const credentials: PostModel = {data: {type: 'RegisteredUser', attributes: login}};
      this.userService.login(credentials)
        .subscribe(
          (response:any) => {
            console.log('response');
            console.log(response);
            localStorage.setItem('token', response.token);
            localStorage.setItem('slug', response.slug);
            this.userService.isAuth = true;
            // router navigate
            this.router.navigate(['']);
            this.toastrService.success("inicio de sesion exitoso", "Login");
          },
          (error) => {
            this.toastrService.error(error.error.message);
            console.log('error');
            console.log(error);
          }
        );
    }
    else
    {
      this.toastrService.error('Datos Invalidos');
      console.log('Datos Invalidos');
    }
  }

  get f() { return this.form.controls; }


}
