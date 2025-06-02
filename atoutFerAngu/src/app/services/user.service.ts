import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Observable, catchError, map, retry, throwError } from 'rxjs';
import { UserInfo } from '../models/user-info';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  apiUrl = environment.apiUrl;

  private currentUser: UserInfo | undefined;


  constructor(private httpClient: HttpClient) { }


  getAll(): Observable<UserInfo[]> {
    return this.httpClient.get<UserInfo[]>(this.apiUrl + "/api/users").pipe(
      retry(1),
      catchError(this.handleError)
    );
  }

  getUserProfile(): Observable<any> {
    const token = localStorage.getItem('token');
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this.httpClient.get<any>(`${this.apiUrl}/api/users/`, { headers });
  }

  getCurrentUserEmail(): string {
    let isToken: any = window.localStorage.getItem("token")
    if (isToken) {
      let base64Url = isToken.split('.')[1];
      let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      let jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function (c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
      }).join(''));
      return JSON.parse(jsonPayload).username;
    } else {
      return "Erreur Inconnu"
    }
  }

  getAllUsers(): Observable<UserInfo[]> {
    return this.httpClient.get<UserInfo[]>(this.apiUrl + '/api/users');
  }

  getCurrentUser(): Observable<UserInfo> {
    if (this.currentUser) {
      return this.httpClient.get<UserInfo>(this.apiUrl + '/api/users/' + this.currentUser.id);
    } else {
      const token = localStorage.getItem('token');
      const headers = new HttpHeaders({ 'Authorization': `Bearer ${token}` });

      return this.httpClient.get<UserInfo>(this.apiUrl + '/api/users', { headers }).pipe(
        map((user: UserInfo) => {
          this.currentUser = user;
          return user;
        }),
        catchError(this.handleError)
      );
    }
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
