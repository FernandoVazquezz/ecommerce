import { Injectable, Input } from '@angular/core';
import { Product } from './product';
import { ProductDatasourceService } from './product-datasource.service';

@Injectable({
  providedIn: 'root'
})
export class ProductRepositoryService {
  private products: Product[] = [];
  private productCode: string[] = [];
  private categories: string[] =[];
  private vendors: string[] =[];
  private scales: string[] =[];
  

  constructor(private dataSourceService: ProductDatasourceService) {
    dataSourceService.getProducts().subscribe((response)=> {
      this.products = response['products'];
      this.categories = response['products'].map(p => p.productLine).filter((c, index, array) => array.indexOf(c) === index).sort();
      this.vendors = response['products'].map(p => p.productVendor).filter((c, index, array) => array.indexOf(c) === index).sort();
      this.scales = response['products'].map(p => p.productScale).filter((c, index, array) => array.indexOf(c) === index).sort();
    });
   }
   

   getProductos(productLine: string = null,productVendor: string = null,productScale: string = null) :Product[]{
    return this.products.filter((p) => (productLine == null || p.productLine === productLine) && (productVendor == null || p.productVendor === productVendor) && (productScale == null || p.productScale === productScale));
 }

  getProduct(productCode: string){
    return this.products.filter((p)=>p.productCode === productCode);
  }


   getCategories(): string[]{
    return this.categories;
  }

  getVendors(): string[]{
    return this.vendors;
  }
  getScales(): string[]{
    return this.scales;
  }
}
