import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { PostModel } from '../models/post-model';
import { RespModel } from '../models/resp-model';
import { Observable } from 'rxjs';
import { Token } from '../models/token';
import { RespSingleModel } from '../models/resp-single-model';

@Injectable({
  providedIn: 'root'
})
export class AgronetService {

  urlApi = 'http://localhost:8000/api/v1/';

  constructor(
    private http: HttpClient
  ) { }

  storeAddr(addr: PostModel): Observable<RespSingleModel>
  {
    console.log('addr');
    console.log(addr);
    const headers = new HttpHeaders(
      {
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
       'Accept': 'application/json',
       'content-type': 'application/json'
      });
    return this.http.post<RespSingleModel>(this.urlApi + 'addrs', addr, { headers });
  }

  login(credentials: PostModel): Observable<Token>
  {
    const headers = new HttpHeaders(
      {
       'content-type': 'application/json'
      });
    return this.http.post<Token>(this.urlApi + 'auth', credentials, { headers });
  }

  storeEvent(event: PostModel): Observable<RespSingleModel>
  {
    console.log("Event");
    console.log(event);
    const headers = new HttpHeaders(
      {
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
       'Accept':'application/json',
       'content-type': 'application/json'
      });
    return this.http.post<RespSingleModel>(this.urlApi + 'events', event, { headers });
  }

  storeGeoLoc(geo: PostModel): Observable<RespSingleModel>
  {
    console.log('GeoLoc');
    console.log(geo);
    const headers = new HttpHeaders(
      {
       'Authorization':'Bearer '+localStorage.getItem('token'),
       'Accept':'application/json',
       'content-type': 'application/json'
      });
    return this.http.post<RespSingleModel>(this.urlApi + 'geo-locations', geo, { headers });
  }

  getNearEvents(lt: number, lng: number, km: number): Observable<RespModel>
  {
    const headers = new HttpHeaders(
      {
       'Accept': 'application/json',
       'content-type': 'application/json'
      });
    return this.http.get<RespModel>(this.urlApi + 'events/geo/' + lt + '/' + lng + '/' + km, { headers });
  }

}
