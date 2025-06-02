import { Component, OnInit, Output } from '@angular/core';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { NgbNavModule } from '@ng-bootstrap/ng-bootstrap';
import { faBasketShopping, faEnvelope, faHouseChimney, faPhone, faUserTie } from '@fortawesome/free-solid-svg-icons';
import { faFacebook, faInstagram, faXTwitter } from '@fortawesome/free-brands-svg-icons';
import { Router, RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../../services/auth.service';

@Component({
  selector: 'app-nav',
  standalone: true,
  imports: [FontAwesomeModule, NgbNavModule, RouterModule, CommonModule],
  templateUrl: './nav.component.html',
  styleUrl: './nav.component.css'
})
export class NavComponent implements OnInit {
  faEnvelope = faEnvelope;
  faHouse = faHouseChimney;
  faPhone = faPhone;
  faFb = faFacebook;
  faInsta = faInstagram;
  faTwitter = faXTwitter;
  faUser = faUserTie;
  faBasket = faBasketShopping;

  logIn = false;
  notifier = false;

  items: [] = [];

  constructor(private router: Router, private authService: AuthService) {
  }

  ngOnInit(): void {
    //Récupération du localStorage
    let retrievedData = localStorage.getItem("cart");
    if (retrievedData) {
      this.items = JSON.parse(retrievedData);
    }
    console.log(this.items);

  }
  logout() {
    window.localStorage.removeItem("token");
    this.router.navigate(["/login"]);
  }

  //Vérifie qu'il y a bien un token dans le localStorage pour modifier la navbar
  loggedIn() {
    if (localStorage.getItem('token')) {
      this.logIn = true;
    } else {
      this.logIn = false;
    }
    return this.logIn;

  }

  //Vérifie s'il y a quelque chose dans le panier pour afficher le badge dans la nav
  basketNotify() {
    if (localStorage.getItem('cart')) {
      this.notifier = true;
    } else {
      this.notifier = false;
    }
    return this.notifier;
  }


}





