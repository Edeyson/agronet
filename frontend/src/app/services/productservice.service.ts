import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Product } from '../components/interfaces/interfaces';

@Injectable({
  providedIn: 'root'
})
export class ProductserviceService {
  urlApi = 'https://api.agrolibre.xyz/api/v1/';

  constructor(private http: HttpClient) { }


  getAll(){
    return this.http.get<any>(this.urlApi+'products');
  }

  getProduct(id){
    return this.http.get<any>(this.urlApi+'products/'+id);
  }
  addProduct(product){
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.post<any>(this.urlApi + 'products', product, { headers });
  }

  updateProduct(product){
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.put<any>(this.urlApi + 'products/'+product.data.id, product, { headers });
  }

  delete(id)
  {
    const headers = new HttpHeaders(
      {
        'Authorization':'Bearer '+localStorage.getItem("token"),
        'Accept':'application/json',
        'content-type': 'application/json'
      });
    return this.http.delete<any>(this.urlApi+'products/'+id, { headers });
  }

}
