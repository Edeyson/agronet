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
  selector: 'app-create-event',
  templateUrl: './create-event.component.html',
  styleUrls: ['./create-event.component.css']
})
export class CreateEventComponent implements OnInit {

  map: Mapboxgl.Map;
  style = 'mapbox://styles/mapbox/streets-v11';
  lat = 5.067391253411557;
  lng = -75.51728230174133;
  form: FormGroup;
  latSelected: number;
  lngSelected: number;
  addrId: string;

  constructor(
    private formBuilder: FormBuilder,
    private agroservive: AgronetService,
    private toastrService: ToastrService,
  ) { }

  ngOnInit(): void
  {
    this.buildMap();

    this.form = this.formBuilder.group({
      location: ['', Validators.required],
      etiqueta: ['', Validators.required],

      fecha: ['', Validators.required],
      hora: ['', Validators.required],
      duracion: ['', Validators.required]
    });
  }

  buildMap(): void
  {
      // Object.getOwnPropertyDescriptor(Mapboxgl, "accessToken").set(environment.mapbox.accessToken);
      (Mapboxgl as any).accessToken = environment.mapbox.accessToken;
      this.map = new Mapboxgl.Map({
        container: 'mapa-mapbox-create-event',
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

  onSubmit(): void
  {
    if (this.validateLatLng(this.latSelected, this.lngSelected))
    {
      if (this.form.valid)
      {
        const addr: Addr =
        {
          registered_user_id: localStorage.getItem('slug'),
          country: 'Colombia',
          province: 'Caldas',
          city: 'Manizales',
          street: this.f.location.value,
          location: this.f.location.value,
          etiqueta: this.f.etiqueta.value
        };
        const postAddr: PostModel = {data: {type: 'Addr', attributes: addr}};
        this.agroservive.storeAddr(postAddr)
          .subscribe(
            (response) => {
              //this.form.reset();
              console.log('response');
              console.log(response);
              // router navigate
              //this.router.navigate(['events']);
              this.addrId = response.data.id + '';

              const geo: GeoLocation =
              {
                latitud: this.latSelected,
                longitud: this.lngSelected,
                addr_id: this.addrId
              };
              const postGeo: PostModel = {data: {type: 'GeoLocation', attributes: geo}};
              this.agroservive.storeGeoLoc(postGeo)
                .subscribe(
                  (response) => {
                    console.log(response);
                  },
                  (error) => {
                    console.log(error);
                  }
                );

              const event: Event =
              {
                producer_id: localStorage.getItem('role_id'),
                addr_id: this.addrId,
                duracion: this.f.duracion.value,
                fecha: this.f.fecha.value,
                hora: this.f.hora.value
              };
              const postEvent: PostModel = {data: {type: 'Event', attributes: event}};
              this.agroservive.storeEvent(postEvent)
                .subscribe(
                  (response) => {
                    console.log(response);
                    this.toastrService.success('Ok');
                    this.form.reset();
                  },
                  (error) => {
                    console.log(error);
                  }
                );
            },
            (error) => {
              this.toastrService.error(error.error.message);
              console.log('error');
              console.log(error);
            }
          );
      }
    }
    else
    {
      this.toastrService.error('Seleccionar Ubicación Válida');
      console.log('Seleccionar Ubicación');
    }
  }

  private get f() { return this.form.controls; }

  private validateLatLng(lat: number, lng: number)
  {
    return lat < 12.5 && lat > -4 && lng > -79 && lng < -67;
  }

}
