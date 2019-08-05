import { Component, OnInit } from '@angular/core';
import { Cart } from 'src/app/model/cart';
import { Product } from 'src/app/model/product';

export interface Transaction {
  Product: string;
  Price: number;
  Quantity: number;
  SubTotal: number;
}

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit {

  displayedColumns: string[] = ['Product', 'Price', 'Quantity', 'SubTotal'];
  transactions: Transaction[] = [
    {Product: 'Beach ball', Price: 4, Quantity: 4, SubTotal:10},
  ];


  constructor(public cart: Cart) { }

 
  ngOnInit() {
  }

}

