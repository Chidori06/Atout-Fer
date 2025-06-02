import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Observable, catchError, retry, throwError } from 'rxjs';
import { Review } from '../models/review';

@Injectable({
  providedIn: 'root'
})
export class ReviewService {

  apiUrl = environment.apiUrl;

  constructor(private httpClient: HttpClient) { }
  getAll(): Observable<Review[]> {
    return this.httpClient.get<Review[]>(this.apiUrl + "/api/reviews").pipe(retry(1), catchError(this.handleError));
  }

  getOneReview(id: number): Observable<Review> {
    return this.httpClient.get<Review>(this.apiUrl + "/reviews/" + id).pipe(retry(1), catchError(this.handleError));
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
