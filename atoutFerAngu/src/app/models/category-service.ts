import { Category } from "./category";
import { Service } from "./service";

export class CategoryService {
    id?: number;
    price?: number;
    categories?: Category;
    services?: Service;

    constructor(id?: number, price?: number, categories?: Category, services?: Service) {
        this.id = id;
        this.price = price;
        this.categories = categories;
        this.services = services;
    }

}
