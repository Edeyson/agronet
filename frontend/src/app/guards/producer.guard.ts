import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { UsuarioserviceService } from '../services/usuarioservice.service';
import { map, catchError } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class ProducerGuard implements CanActivate {
  constructor(
    private usuariosService: UsuarioserviceService,
    private router: Router
  ){}
  canActivate(): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree
  {
      return this.usuariosService.isProducer()
                  .pipe(
                    map(() => true),
                    catchError(() => this.router.navigate(['/login']))
              );
  }
  
}
