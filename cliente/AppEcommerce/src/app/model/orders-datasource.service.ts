import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Orders } from './orders';

const PROTOCOL = 'http';

@Injectable({
  providedIn: 'root'
})
export class OrdersDatasourceService {

  private baseUrl: string;

  constructor(private httpClient: HttpClient) {
    this.baseUrl = `${PROTOCOL}://${location.hostname}/ecommerce/api`;
 };

  getOrders(): any{
    return this.httpClient.get(this.baseUrl + '/orders');
  }

  postOrders(order: any[]): any{
    this.httpClient.post(this.baseUrl + '/orders', order)
  }
}
