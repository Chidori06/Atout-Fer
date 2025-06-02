import { Component, OnInit } from '@angular/core';
import { Review } from '../../models/review';
import { Router, RouterModule } from '@angular/router';
import { ReviewService } from '../../services/review.service';
import { CommonModule } from '@angular/common';
import { NgbRating } from '@ng-bootstrap/ng-bootstrap';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faCat } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-review',
  standalone: true,
  imports: [CommonModule, RouterModule, NgbRating, FontAwesomeModule],
  templateUrl: './review.component.html',
  styleUrl: './review.component.css'
})
export class ReviewComponent implements OnInit {
  reviews?: Review[] = [];
  faCat = faCat;

  constructor(private router: Router, private reviewService: ReviewService) {
  }

  ngOnInit(): void {

    this.reviewService.getAll().subscribe(data => {
      this.reviews = data;


    })
  }

}
