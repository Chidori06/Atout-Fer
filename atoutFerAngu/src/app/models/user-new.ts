export class UserNew {
    id?: number;
    email?: string;
    password?: string;
    firstname?: string;
    lastname?: string;
    gender?: string;
    birthdate?: string;

    constructor(id?: number, email?: string, password?: string, firstname?: string,
        lastname?: string, gender?: string, birthdate?: string) {
        this.id = id;
        this.email = email;
        this.password = password;
        this.firstname = firstname;
        this.lastname = lastname;
        this.gender = gender;
        this.birthdate = birthdate;

    }
}
