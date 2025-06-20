import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Observable, catchError, retry, throwError } from 'rxjs';
import { OrderLine } from '../models/order-line';

@Injectable({
  providedIn: 'root'
})
export class OrderLinesService {

  apiUrl = environment.apiUrl;

  constructor(private httpClient: HttpClient) { }

  postLines(orderLine: OrderLine): Observable<OrderLine[]> {
    return this.httpClient.post<OrderLine[]>(this.apiUrl + "/api/order_lines", orderLine).pipe(retry(1), catchError(this.handleError));
  }

  private handleError(error: HttpErrorResponse) {
    if (error.status === 0) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.error);
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong.
      console.error(
        `Backend returned code ${error.status}, body was: `, error.error);
    }
    // Return an observable with a user-facing error message.
    return throwError(() => new Error('Something bad happened; please try again later.'));
  }

}
