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

  
  constructor(public cart:Cart) { }
  private cartes;
  
    ngOnInit() {
    }
  
    get productcart():any[]{
       this.cartes=this.cart.getproductsCart();
       return this.cartes;
    }
  
    addcart(product:Product,canti:number){
    
    this.cart.changequantity(product,+canti);
    }
    deleteproductos(product:Product)
    {
      
      this.cart.deleteproduct(product);
    }


}

