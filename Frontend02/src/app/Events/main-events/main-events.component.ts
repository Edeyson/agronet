import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { environment } from '../../../environments/environment';
import * as Mapboxgl from 'mapbox-gl';
import { Addr } from 'src/app/models/addr';
import { PostModel } from 'src/app/models/post-model';
import { AgronetService } from '../../services/agronet.service';
import { RespModel } from '../../models/resp-model';
import { ToastrService } from 'ngx-toastr';
import { Event } from 'src/app/models/event';
import { GeoLocation } from '../../models/geo-location';

@Component({
  selector: 'app-main-events',
  templateUrl: './main-events.component.html',
  styleUrls: ['./main-events.component.css']
})
export class MainEventsComponent implements OnInit
{
  map: Mapboxgl.Map;
  style = 'mapbox://styles/mapbox/streets-v11';
  lat = 5.067391253411557;
  lng = -75.51728230174133;
  form: FormGroup;
  latSelected: number;
  lngSelected: number;
  addrId: string;
  markers: Mapboxgl.Marker[];

  constructor(
    private formBuilder: FormBuilder,
    private agroservive: AgronetService,
    private toastrService: ToastrService,
  )
  {
    this.markers = [];
  }

  ngOnInit(): void
  {
    this.buildMap();
  }

  buildMap(): void
  {
      // Object.getOwnPropertyDescriptor(Mapboxgl, "accessToken").set(environment.mapbox.accessToken);
      (Mapboxgl as any).accessToken = environment.mapbox.accessToken;
      this.map = new Mapboxgl.Map({
        container: 'mapa-mapbox-events',
        style: this.style,
        zoom: 17,
        center: [this.lng, this.lat]
      });
      // Add map controls
      this.map.addControl(new Mapboxgl.NavigationControl());
      this.map.addControl(
        new Mapboxgl.GeolocateControl({
          positionOptions: {
            enableHighAccuracy: true
          },
          trackUserLocation: true
        })
      );

      const marker = new Mapboxgl.Marker({
        draggable: false
      });

      this.map.on('click', (ev) => {
        console.log(ev.lngLat);
        marker.setLngLat(ev.lngLat).addTo(this.map);
        this.latSelected = ev.lngLat.lat;
        this.lngSelected = ev.lngLat.lng;
      });

  }

  async events(km: number)
  {
      console.log('evts');
      const geos = await this.agroservive.getNearEvents(this.latSelected, this.lngSelected, km).toPromise();
      console.log("Near")
      console.log(geos)
      let cant = geos.meta.count;
      let c = this.markers?.length | 0;
      for(let i=0; i<c; i++)
      {
        this.markers[i].remove();
      }
      for (let i = 0; i < cant; i++)
      {
        console.log('Geo i: ')
        console.log(geos.data[i]);
        const marker = new Mapboxgl.Marker({draggable: false, color: 'red'});
        marker.setLngLat([(geos.data[i] as any).attributes.longitud, (geos.data[i] as any).attributes.latitud]).addTo(this.map);
        this.markers.push(marker);
      }
  }

}
