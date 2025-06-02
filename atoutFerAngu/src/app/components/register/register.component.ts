import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { AuthService } from '../../services/auth.service';
import { UserNew } from '../../models/user-new';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NgbAlertModule, NgbDatepickerModule, NgbDateStruct } from '@ng-bootstrap/ng-bootstrap';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faCalendar, faEye, faEyeSlash } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [RouterModule, CommonModule, FormsModule, ReactiveFormsModule, NgbAlertModule, NgbDatepickerModule, FontAwesomeModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent {

  user: UserNew = new UserNew();
  error: string = '';
  isLoading: boolean = false;
  genres: string[] = ["Homme", "Femme", "Ne se prononce pas"];
  faCalendar = faCalendar;
  faEyeSlash = faEyeSlash;
  faEye = faEye;

  fieldTextType?: boolean;
  fieldTextType2?: boolean;

  constructor(private router: Router, private authService: AuthService) { }

  addUser() {
    this.isLoading = true;
    this.authService.registerUser(this.user).subscribe(data => {
      this.router.navigate(['/login']);
    }, error => {
      this.error = error.type.replace('\n', '<br>');
      this.isLoading = false;
    })
  }

  //Changer d'icônes
  toggleFieldTextType() {
    this.fieldTextType = !this.fieldTextType;
  }

  toggleFieldTextType2() {
    this.fieldTextType2 = !this.fieldTextType2;
  }
}
