import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, catchError, retry, throwError } from 'rxjs';
import { Service } from '../models/service';
import { environment } from '../../environments/environment.development';

@Injectable({
  providedIn: 'root'
})
export class ServiceService {

  apiUrl = environment.apiUrl;

  constructor(private httpClient: HttpClient) { }
  getAll(): Observable<Service[]> {
    return this.httpClient.get<Service[]>(this.apiUrl + "/api/services").pipe(retry(1), catchError(this.handleError));
  }


  /*getOne(id: number): Observable<Service> {
    return this.httpClient.get<Service>(this.apiUrl + "/services/" + id).pipe(retry(1), catchError(this.handleError));
  }*/


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
