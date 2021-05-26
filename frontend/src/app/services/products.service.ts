import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ProductsService 
{

  constructor(private http: HttpClient) { }

  getAllProducts()
  {
    const headers = new HttpHeaders(
      {
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.get<any>(environment.apiUrl+"products", { headers: headers });
  }
}
