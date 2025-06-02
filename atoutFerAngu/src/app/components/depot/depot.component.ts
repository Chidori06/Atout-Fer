import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { CategoryService } from '../../models/category-service';
import { CategoryServiceService } from '../../services/category-service.service';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


@Component({
  selector: 'app-depot',
  standalone: true,
  imports: [RouterModule, CommonModule, ReactiveFormsModule, FormsModule],
  templateUrl: './depot.component.html',
  styleUrl: './depot.component.css'
})
export class DepotComponent implements OnInit {
  categoriesSelect?: CategoryService[];
  list: CategoryService[] = [];
  isLoading = true;

  constructor(private categoryServService: CategoryServiceService,
    private router: Router) {
  }

  ngOnInit(): void {
    this.categoryServService.getAll().subscribe(data => {
      this.isLoading = false;
      this.categoriesSelect = data;
    })
  }

  addItemToList(categoriesSelect: CategoryService) {
    this.list.push(categoriesSelect);

  }

  removeItemFromList(index: number) {
    this.list.splice(index, 1);
    if (this.list.length === 0) {
      localStorage.removeItem('cart');

    } else {
      localStorage.setItem('cart', JSON.stringify(this.list));

    }
  }

  getPriceTotal(): number {
    return this.list.reduce((total, item) => total + (item.price || 0), 0);
  }

  validBasket(list: any) {
    let storedList = "";
    if (list.length != 0) {
      let storedList = localStorage.setItem("cart", JSON.stringify(this.list));
    }

  }



}

