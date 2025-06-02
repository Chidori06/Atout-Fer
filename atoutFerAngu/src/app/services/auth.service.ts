import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { User } from '../models/user';
import { Observable, catchError, map, retry, throwError } from 'rxjs';
import { UserNew } from '../models/user-new';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  apiUrl = environment.apiUrl;


  constructor(private httpClient: HttpClient) { }


  login(user: User): Observable<{ token: string }> {
    return this.httpClient.post<{ token: string }>(this.apiUrl + "/auth", user).pipe(
      retry(1),
      catchError(this.handleError),
    );

  }

  registerUser(user: UserNew): Observable<UserNew> {
    return this.httpClient.post<UserNew>(this.apiUrl + '/api/users', user).pipe(
      retry(1),
      catchError(this.handleError)
    );
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
    return throwError(() => new ErrorEvent(error.error.message));
  }
}
