import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { User } from '../../models/user';
import { AuthService } from '../../services/auth.service';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faEye, faEyeSlash } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, RouterModule, ReactiveFormsModule, FormsModule, FontAwesomeModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  user: User = new User();
  strError?: string;
  isLoading = false;

  faEyeSlash = faEyeSlash;
  faEye = faEye;

  fieldTextType?: boolean;


  constructor(private authService: AuthService, private router: Router) { }

  loggedUser() {
    this.isLoading = true;
    this.authService.login(this.user).subscribe(data => {
      localStorage.setItem("token", data.token);
      this.router.navigate(["/"]);
    }, error => {
      console.log(error);
      this.strError = error["type"];
      this.isLoading = false;
    })
  };

  //Changer d'icônes
  toggleFieldTextType() {
    this.fieldTextType = !this.fieldTextType;
  }
}
