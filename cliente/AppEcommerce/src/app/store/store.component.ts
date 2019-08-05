import { Component, OnInit } from '@angular/core';
import { ProductRepositoryService } from '../model/product-repository.service';
import { Product } from '../model/product';
import { Cart } from 'src/app/model/cart';

@Component({
  selector: 'app-store',
  templateUrl: './store.component.html',
  styleUrls: ['./store.component.css']
})
export class StoreComponent implements OnInit {

  public selectedScale = null;
  public selectedVendor = null;
  public selectedCategory = null;
  public productsPerPage = 12;
  public selectedPage = 1;

  constructor(private productRepoService: ProductRepositoryService, public cart: Cart) { }

  ngOnInit() {
    
  }

  get products(): Product[]{
    const pageIndex = (this.selectedPage - 1) * this.productsPerPage;
    return this.productRepoService.getProductos(this.selectedCategory,this.selectedVendor,this.selectedScale).slice(pageIndex, pageIndex + this.productsPerPage);
  }

  get categories(): string[]{
    return this.productRepoService.getCategories();
  }

  get vendors(): string[]{
    return this.productRepoService.getVendors();
  }

  get scales(): string[]{
    return this.productRepoService.getScales();
  }

  changeCategory(newCategory?: string){
    this.selectedCategory = newCategory;
    this.selectedPage = 1;
  }

  changeVendor(newVendor?: string){
    this.selectedVendor = newVendor;
    this.selectedPage = 1;
  }

  changeScale(newScale?: string){
    this.selectedScale = newScale;
    this.selectedPage = 1;
  }

  get pageNumbers(): number[]{
    return Array(Math.ceil(this.productRepoService.getProductos(this.selectedCategory,this.selectedVendor,this.selectedScale).length / this.productsPerPage))
    .fill(0).map((x, i) => i+1); // [1,2,3,4,5,6,...]
  }

  changePage(newNumber: number) {
    this.selectedPage = newNumber;
  }

  changePageSize(newSize: number){
    this.productsPerPage = newSize;
    this.changePage(1);
  }
  
}
