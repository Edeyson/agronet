import { Component, OnInit } from '@angular/core';
import { FormsModule} from '@angular/forms';

@Component({
  selector: 'app-productos',
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.scss']
})
export class ProductosComponent implements OnInit {

  public articulos: any;

  public filtrarProducto = '';

  constructor() { 
    this.loadNews();
  }

  

  ngOnInit(): void {
    
  }

  loadNews(){
    
  }

}
