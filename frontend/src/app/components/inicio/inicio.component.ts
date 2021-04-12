import { Component, OnInit } from '@angular/core';
import { NewsApiService } from 'src/app/services/news-api.service';

@Component({
  selector: 'app-inicio',
  templateUrl: './inicio.component.html',
  styleUrls: ['./inicio.component.scss']
})
export class InicioComponent implements OnInit {

 public articles: any;

  constructor(private newsService:NewsApiService) { 
    this.loadNews();
  }

  ngOnInit(): void {
    
  }

  loadNews(){
    this.newsService.getNews("everything?q=tesla&from=2021-03-11&sortBy=publishedAt").subscribe( news =>{
      this.articles = news;
      this.articles = this.articles.articles;
      console.log("articulos",this.articles);
    });
  }
  
}
