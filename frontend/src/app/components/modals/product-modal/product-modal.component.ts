import { Component, Input, OnInit } from '@angular/core';


@Component({
  selector: 'app-productmodal',
  templateUrl: './product-modal.component.html',
  styleUrls: ['./product-modal.component.scss']
})
export class ProductModalComponent implements OnInit {
  
  public input:any;

  public articulos: any;
  @Input() article:any;


  constructor() { 
  }

  ngOnInit(): void {
  }

}
