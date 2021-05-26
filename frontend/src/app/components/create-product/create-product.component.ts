import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { CategoriesService } from 'src/app/services/categories.service';
import { ProductserviceService } from 'src/app/services/productservice.service';
import { Product } from '../interfaces/interfaces';
interface Categoria {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-create-product',
  templateUrl: './create-product.component.html',
  styleUrls: ['./create-product.component.scss']
})
export class CreateProductComponent implements OnInit {

  public categories: any[] = [];
  isEdit: boolean = false;
  product = {
    data: {
      type: 'Product',
        attributes: {
          producer_id: +localStorage.getItem('slug'),
          category_id: 0,
          image_path: 'imagen',
          name: '',
          description: '',
          measurement: 10,
          price: 0,
        },
    }
  };
  constructor(private formBuilder: FormBuilder, 
    private categoriesService: CategoriesService,
    private prodService: ProductserviceService,
    private activatedRoute: ActivatedRoute,
    private router: Router) { }

  ngOnInit(): void {
    const propertyId = this.activatedRoute.snapshot.paramMap.get('id');
    if(propertyId){
      this.isEdit = true;
      this.prodService.getProduct(propertyId).subscribe((res) => {
        this.product = res;
      });
    }
    this.loadCategories();
  }

  loadCategories()
  {
    this.categoriesService.getAll().subscribe(
      res => {
        this.categories = res.data
      }
    );
  }

  createProduct() {
    this.prodService.addProduct(this.product).subscribe((res)=>{
      console.log(res);
      this.router.navigate(['/inicio']);
    });
  }

  updateProduct() {
    this.prodService.updateProduct(this.product).subscribe((res)=>{
      console.log(res);
      this.router.navigate(['/inicio']);
    })
  }

  exit() {
    console.log('Bye');
    this.router.navigate(['/inicio']);
  }

}
