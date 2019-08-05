import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProductDatasourceService } from './product-datasource.service';
import { ProductRepositoryService } from './product-repository.service';
import {MatTableModule} from '@angular/material/table';

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    MatTableModule
  ],
  providers: [ProductDatasourceService, ProductRepositoryService]
})
export class ModelModule { }
