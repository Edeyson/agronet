import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-productmodal',
  templateUrl: './product-modal.component.html',
  styleUrls: ['./product-modal.component.scss']
})
export class ProductModalComponent implements OnInit {
  

  public producto = "";
  constructor(private route: ActivatedRoute) { 
  }

  ngOnInit(): void {
    this.route.params.subscribe(parametro=>{
      console.log(parametro.id);
      this.producto = parametro.id;
    });
  }

}
