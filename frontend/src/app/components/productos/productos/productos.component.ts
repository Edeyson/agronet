import { Component, OnInit } from '@angular/core';
import { NewsApiService } from 'src/app/services/news-api.service';

@Component({
  selector: 'app-productos',
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.scss']
})
export class ProductosComponent implements OnInit {

  public articulos: any;

  constructor(private newsService:NewsApiService) { 
    this.loadNews();
  }

  ngOnInit(): void {
    
  }

  loadNews(){
    this.newsService.getNews("everything?q=tesla&from=2021-03-11&sortBy=publishedAt").subscribe( news =>{
      this.articulos = news;
      this.articulos = this.articulos.articles;
      console.log("articulos",this.articulos);
    });
  }

}
