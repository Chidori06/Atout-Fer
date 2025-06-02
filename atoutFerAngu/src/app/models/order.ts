import { Address } from "./address";
import { Status } from "./status";
import { UserInfo } from "./user-info";

export class Order {
    id?: number;
    // addressOrder?: Address;
    user?: string;
    total?: number;
    payment?: string;
    orderDate?: Date;
    statusOrder?: string;


    constructor(id?: number, user?: string, total?: number, payment?: string, orderDate?: Date,
        statusOrder?: string) {
        this.id = id;
        // this.addressOrder = addressOrder;
        this.user = user;
        this.total = total;
        this.payment = payment;
        this.orderDate = orderDate;
        this.statusOrder = statusOrder;

    }

}
