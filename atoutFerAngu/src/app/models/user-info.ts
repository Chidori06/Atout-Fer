import { Address } from "./address";
import { Order } from "./order";
import { Review } from "./review";

export class UserInfo {
    id?: number;
    email?: string;
    password?: string;
    firstname?: string;
    lastname?: string;
    gender?: string;
    birthdate?: string;
    addresses?: Address;
    reviews?: Review;
    orders?: Order;

    constructor(id?: number, email?: string, password?: string, firstname?: string,
        lastname?: string, gender?: string, birthdate?: string, addresses?: Address, reviews?: Review, orders?: Order) {
        this.id = id;
        this.email = email;
        this.password = password;
        this.firstname = firstname;
        this.lastname = lastname;
        this.gender = gender;
        this.birthdate = birthdate;
        this.addresses = addresses;
        this.reviews = reviews;
        this.orders = orders;

    }
}
