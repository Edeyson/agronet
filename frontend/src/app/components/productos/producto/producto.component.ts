import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-producto',
  templateUrl: './producto.component.html',
  styleUrls: ['./producto.component.scss']
})
export class ProductoComponent implements OnInit {

  @Input() article:any;
  public codigo:any;

  constructor() { }

  ngOnInit(): void {
  }

  articuloSelected(){
    console.log("Selected: ",this.article);
  }

}
