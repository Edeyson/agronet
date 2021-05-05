import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { PostModel } from '../components/interfaces/post-model';


@Injectable({
  providedIn: 'root'
})
export class UsuarioserviceService {

  constructor(private http: HttpClient) { }

  public registrar(user: PostModel){
    console.log("user en servicio: ",user);
    
    return this.http.post<{ token: string }>('http://143.198.127.182/api/register',user);
  }
}
