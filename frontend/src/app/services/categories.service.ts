import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CategoriesService 
{
  urlApi = 'https://api.agrolibre.xyz/api/v1/';

  constructor(private http: HttpClient) { }

  getAll(){
    return this.http.get<any>(this.urlApi+'categorys');
  }

}
