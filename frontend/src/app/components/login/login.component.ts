import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit 
{
  public loginForm = new FormGroup({
    email: new FormControl('', Validators.required),
    password: new FormControl('', Validators.required)
  });

  constructor(
    private authService: AuthService
  ) { }

  ngOnInit(): void {
  }

  login()
  {
    this.authService.login(this.loginForm.value).subscribe(
      res => {
        console.log(res);
      }
    );
  }

}
