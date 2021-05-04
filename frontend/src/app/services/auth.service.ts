import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService 
{

  constructor(
    private http: HttpClient
  ) { }

  login(loginData: any)
  {
    return this.http.post(environment.API_BACKEND_URL + 'login', loginData);
  }
}
