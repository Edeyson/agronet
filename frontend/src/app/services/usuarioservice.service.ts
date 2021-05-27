import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { PostModel } from '../components/interfaces/post-model';
import { Token } from '../components/interfaces/token';


@Injectable({
  providedIn: 'root'
})
export class UsuarioserviceService {
  urlApi = 'https://api.agrolibre.xyz/api/v1/';

  public isAuth: boolean = false;

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

  public perfil(){
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.get<any>(this.urlApi + "users/"+localStorage.getItem("slug"),{ headers: headers});
  }
  public producer(id){
    return this.http.get<any>(this.urlApi + "producer/"+id);
  }

  public logOut(){
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.delete(this.urlApi + "auth/",{ headers: headers});
    
  }


  isProducer()
  {
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.get<any>(this.urlApi+"producers/"+localStorage.getItem("slug"), { headers: headers });

  }
  
  islogueado()
  {
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.get<any>(this.urlApi + "users/"+localStorage.getItem("slug"),{ headers: headers});
  }


  serProducer(){
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    let producer = {
      data:{
        type:"Producer",
        attributes:{
          id:localStorage.getItem("slug")
        }
      }
    }
    return this.http.post<any>(this.urlApi+'producers',producer,{headers:headers});
  }

}
