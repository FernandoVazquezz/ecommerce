import { Injectable } from '@angular/core';
import { Product } from './product';

@Injectable()
export class Cart {
    public lines: CartLine[] =[];
    public itemCount =0;
    public cartPrice =0;
    public MSRP =0;
    public PName = "";

    addLine(product: Product, quantity: number= 1) {
        const line = this.lines.find(line => line.product.productCode === product.productCode);
        if(line != undefined){
            line.quantity += quantity;
        }else{
            this.lines.push(new CartLine(product,quantity));
        }
    }

    getproductsCart(){
       
        return this.lines;
        }


    deleteproduct(product:Product){
            const line=this.lines.findIndex(line=>line.product.productCode===product.productCode);
            if(line!=undefined){
                this.lines.splice(line,1);
                this.recalculate();
                    }
        }

    changequantity(product:Product,cue:number ){
            const line=this.lines.find(line=>line.product.productCode===product.productCode);
            if(line!=undefined){
                line.quantity=cue;
           this.recalculate();
                }
        }
    
    getcuantity(){
           
            return this.lines.map(p=>p.product);
            }    

    recalculate(){
        this.itemCount=0;
        this.cartPrice=0;
        this.MSRP=0;
        this.PName="";
        this.lines.forEach(l => {
            this.itemCount += l.quantity;
            this.MSRP += l.product.MSRP;
            this.PName = l.product.productName;
            this.cartPrice += (l.quantity * l.product.MSRP);
        });
    }
}



export class CartLine{
    constructor(public product: Product, public quantity: number){}

        get lineTotal(): number {
            return this.quantity * this.product.MSRP;
        }
    
}
