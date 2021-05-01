import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AgronetService } from '../services/agronet.service';
import { PostModel } from 'src/app/models/post-model';
import { RespModel } from '../models/resp-model';
import { Router } from '@angular/router';
import { Login } from '../models/login';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  form: FormGroup;

  constructor(
    private agroservive: AgronetService,
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
      this.agroservive.login(credentials)
        .subscribe(
          (response) => {
            console.log('response');
            console.log(response);
            localStorage.setItem('token', response.token);
            localStorage.setItem('slug', response.slug);
            localStorage.setItem('role_id', response.role_id);
            // router navigate
            this.router.navigate(['create-event']);
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
