import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Observable, catchError, retry, throwError } from 'rxjs';
import { Status } from '../models/status';

@Injectable({
  providedIn: 'root'
})
export class StatusService {

  apiUrl = environment.apiUrl;

  constructor(private httpClient: HttpClient) { }

  getAll(): Observable<Status[]> {
    return this.httpClient.get<Status[]>(this.apiUrl + "/api/status").pipe(retry(1), catchError(this.handleError));
  }

  getOne(id: number): Observable<Status> {
    return this.httpClient.get<Status>(this.apiUrl + "/categories/" + id).pipe(retry(1), catchError(this.handleError));
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
