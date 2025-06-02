import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Address } from '../models/address';
import { Observable, catchError, merge, of, retry, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AddressService {

  apiUrl = environment.apiUrl;


  constructor(private httpClient: HttpClient) { }

  getAll(): Observable<Address[]> {
    return this.httpClient.get<Address[]>(this.apiUrl + "/api/addresses").pipe(retry(1), catchError(this.handleError));
  }

  getOne(id: number): Observable<Address> {
    return this.httpClient.get<Address>(this.apiUrl + "/api/addresses/" + id).pipe(retry(1), catchError(this.handleError));
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
    return throwError(() => new ErrorEvent(error.error["hydra:description"]));
  }
}
