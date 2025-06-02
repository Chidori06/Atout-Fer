import { User } from "./user";
import { UserNew } from "./user-new";
export class Review {
    id?: number;
    rating?: number;
    content?: Text;
    user?: UserNew;

    constructor(id?: number, rating?: number, content?: Text, user?: UserNew) {
        this.id = id;
        this.rating = rating;
        this.content = content;
        this.user = user;
    }
}
