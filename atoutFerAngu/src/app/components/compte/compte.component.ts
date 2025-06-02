import { Component, OnInit } from '@angular/core';
import { UserNew } from '../../models/user-new';
import { Router, RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faCat } from '@fortawesome/free-solid-svg-icons';
import { UserService } from '../../services/user.service';
import { Address } from '../../models/address';
import { AddressService } from '../../services/address.service';
import { UserInfo } from '../../models/user-info';

@Component({
  selector: 'app-compte',
  standalone: true,
  imports: [CommonModule, RouterModule, FontAwesomeModule],
  templateUrl: './compte.component.html',
  styleUrl: './compte.component.css'
})
export class CompteComponent implements OnInit {
  users: UserInfo[] = [];
  user?: UserInfo;
  faCat = faCat;

  constructor(private userService: UserService, private router: Router, private addressService: AddressService) {
  }

  ngOnInit(): void {
    this.compareUsers();

  }

  compareUsers(): void {
    // Récupération de l'e-mail de l'utilisateur actuellement connecté
    const currentUserEmail = this.userService.getCurrentUserEmail();

    this.userService.getAllUsers().subscribe(data => {
      this.users = data
      const foundUser = this.users.find(user => user.email === currentUserEmail);
      this.user = foundUser;

    }
    );

  }

}



