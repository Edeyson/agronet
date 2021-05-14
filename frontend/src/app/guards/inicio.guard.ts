import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { catchError, map } from 'rxjs/operators';
import { UsuarioserviceService } from '../services/usuarioservice.service';

@Injectable({
  providedIn: 'root'
})
export class InicioGuard implements CanActivate {
  constructor(
    private usuariosService: UsuarioserviceService,
    private router: Router
  ){}
  canActivate(): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree
  {
      return this.usuariosService.islogueado()
                  .pipe(
                    map(() => true),
                    catchError(() => this.router.navigate(['/login']))
              );
  
  }
  
}
