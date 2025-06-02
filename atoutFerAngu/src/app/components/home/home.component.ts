import { Component } from '@angular/core';
import { NavComponent } from '../parts/nav/nav.component';
import { RouterModule } from '@angular/router';
import { ContactComponent } from '../contact/contact.component';
import { ReviewComponent } from '../review/review.component';


@Component({
  selector: 'app-home',
  standalone: true,
  imports: [NavComponent, RouterModule, ContactComponent, ReviewComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent {

}
