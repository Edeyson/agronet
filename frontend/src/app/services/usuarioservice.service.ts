import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { PostModel } from '../components/interfaces/post-model';
import { Token } from '../components/interfaces/token';


@Injectable({
  providedIn: 'root'
})
export class UsuarioserviceService {
  urlApi = 'http://143.198.127.182/api/v1/';

  constructor(private http: HttpClient) { }

  public registrar(user: PostModel){
    console.log("user en servicio: ",user);
    
    return this.http.post<{ token: string }>(this.urlApi + 'users',user);
  }


  public login(credentials: PostModel): Observable<Token>
  {
    const headers = new HttpHeaders(
      {
       'content-type': 'application/json'
      });
    return this.http.post<Token>(this.urlApi + 'auth', credentials, { headers });
  }
}
