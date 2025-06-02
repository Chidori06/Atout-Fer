import { Component, OnInit } from '@angular/core';
import { CategoryService } from '../../models/category-service';
import { CommonModule } from '@angular/common';
import { Router, RouterModule } from '@angular/router';
import { UserInfo } from '../../models/user-info';
import { OrderService } from '../../services/order.service';
import { OrderLinesService } from '../../services/order-lines.service';
import { UserService } from '../../services/user.service';
import { OrderLine } from '../../models/order-line';
import { Order } from '../../models/order';

@Component({
  selector: 'app-panier',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './panier.component.html',
  styleUrl: './panier.component.css'
})
export class PanierComponent implements OnInit {

  items: CategoryService[] = [];
  users?: UserInfo[] = [];
  user?: UserInfo;
  payment: string = "Carte Bancaire";
  id?: number;
  uriCatServ?: string;


  constructor(private router: Router, private orderService: OrderService, private orderLinesService: OrderLinesService,
    private userService: UserService) { }

  ngOnInit(): void {
    //Récupération du localStorage
    let retrievedData = localStorage.getItem("cart");
    if (retrievedData) {
      this.items = JSON.parse(retrievedData);

    }

  }

  removeItemFromList(index: number) {
    this.items.splice(index, 1);
    if (this.items.length === 0) {
      localStorage.removeItem('cart');

    } else {
      localStorage.setItem('cart', JSON.stringify(this.items));

    }
    return this.items.length;
  }

  getPriceTotal(): number {
    return this.items.reduce((total, item) => total + (item.price || 0), 0);
  }

  sendCommand() {
    //Envoi de la commande en récupérant les données et les envoyant dans les bonnes tables
    const retrievedData = localStorage.getItem("cart");
    if (retrievedData) {
      this.items = JSON.parse(retrievedData);
      let total = 0;
      for (const item of this.items) {
        total += item.price || 0;
      }

      const currentUserEmail = this.userService.getCurrentUserEmail();

      this.userService.getAll().subscribe(
        data => {
          data.forEach(
            elem => {
              if (elem.email == currentUserEmail) {
                this.id = elem.id
              }
            }
          )

          //Poster la commande
          let orderData = new Order(
            undefined,
            "/api/users/" + this.id,
            total,
            this.payment,
            new Date(),
            "/api/statuses/1",
          );


          this.orderService.postOrder(orderData).subscribe(
            (response) => {
              console.log('Commande enregistrée avec succès : ', response);
              console.log(orderData);
            },
            (error) => {
              console.error('Erreur lors de l\'enregistrement de la commande : ', error);
            }
          );

          //Poster chaque ligne de commande
          const catServId = [];
          for (const elem of this.items) {
            catServId.push(elem.id);
          }

          catServId.forEach(catS => {
            let orderLinesData = new OrderLine
              (undefined,
                this.uriCatServ = "/api/category_services/" + catS,
                "/api/orders/" + orderData.id
              );

            console.log(orderData.id);
            this.orderLinesService.postLines(orderLinesData).subscribe(
              (response) => {
                console.log('Ligne enregistrée avec succès : ', response);
                this.router.navigate(['/compte']);
              },
              (error) => {
                console.error('Erreur lors de l\'enregistrement de la commande : ', error);
              }
            );
          });
        });
    }

  }

}


