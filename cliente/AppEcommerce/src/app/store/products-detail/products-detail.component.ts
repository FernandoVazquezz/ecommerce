import { Component, OnInit, Input } from '@angular/core';
import { Params, ActivatedRoute, Router, ParamMap } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { ProductRepositoryService } from 'src/app/model/product-repository.service';
import { Product } from 'src/app/model/product';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-products-detail',
  templateUrl: './products-detail.component.html',
  styleUrls: ['./products-detail.component.css']
})
export class ProductsDetailComponent implements OnInit {

  product$: Observable<Product>;
  constructor(private route: ActivatedRoute, private router:Router, private service: ProductRepositoryService) { }
  ngOnInit() {
    this.product$ = this.route.paramMap.pipe(
      switchMap((params: ParamMap) => this.service.getProduct(params.get('id')))
    );
  }

  gotoProducts(){
    this.router.navigate(['/products']);
  }
}
