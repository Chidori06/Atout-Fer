import { UserNew } from "./user-new";

export class Address {
    id?: number;
    userAddress?: UserNew;
    number?: string;
    street?: string;
    additionnal?: string;
    postcode?: string;
    city?: string;

    constructor(id?: number, userAddress?: UserNew, number?: string, street?: string, additionnal?: string, postcode?: string,
        city?: string) {
        this.id = id;
        this.userAddress = userAddress;
        this.number = number;
        this.street = street;
        this.additionnal = additionnal;
        this.postcode = postcode;
        this.city = city;
    }
}
