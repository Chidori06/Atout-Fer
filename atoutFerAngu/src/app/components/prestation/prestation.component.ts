import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { Service } from '../../models/service';
import { ServiceService } from '../../services/service.service';
import { environment } from '../../../environments/environment.development';

@Component({
  selector: 'app-prestation',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './prestation.component.html',
  styleUrl: './prestation.component.css'
})
export class PrestationComponent implements OnInit {
  isLoading = true;
  services?: Service[];

  imageUrl: string = environment.imageUrl;

  constructor(private router: Router, private serviceService: ServiceService) {
  }

  ngOnInit(): void {
    this.serviceService.getAll().subscribe(data => {
      this.services = data;
      this.isLoading = false;
    })
  }
}
