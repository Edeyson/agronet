import { Component, OnInit } from '@angular/core';
import { NewsApiService } from 'src/app/services/news-api.service';
import { FormsModule} from '@angular/forms';
import { Product } from '../../interfaces/interfaces';

@Component({
  selector: 'app-productos',
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.scss']
})
export class ProductosComponent implements OnInit 
{
  public products: Product[] = [];

  public articulos: any;

  public filtrarProducto = '';

  constructor(private newsService:NewsApiService) { 
    // this.loadNews();
  }

  ngOnInit(): void {
    this.loadProducts();
  }

  loadProducts()
  {
    this.products = [];

    for (let i = 0; i < 20; i++) 
    {
      const product: Product = {
        id: i+1,
        name: `producto ${i}`,
        description: `Descripcionnnnn ${i}`,
        price: 100*i,
        image_url: 'https://via.placeholder.com/300'
      }   
  
      this.products.push(product);
    }
  }

  loadNews(){
    this.newsService.getNews("everything?q=tesla&from=2021-03-12&sortBy=publishedAt").subscribe( news =>{
      this.articulos = news;
      this.articulos = this.articulos.articles;
      console.log("articulos",this.articulos);
    });
  }

}
