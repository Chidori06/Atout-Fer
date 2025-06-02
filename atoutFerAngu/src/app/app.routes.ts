import { Routes } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { PrestationComponent } from './components/prestation/prestation.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { PresentationComponent } from './components/presentation/presentation.component';
import { DepotComponent } from './components/depot/depot.component';
import { PanierComponent } from './components/panier/panier.component';
import { CompteComponent } from './components/compte/compte.component';
import { authGuard } from './guards/auth.guard';

export const routes: Routes = [
    { path: '', component: HomeComponent },
    { path: 'prestations', component: PrestationComponent },
    { path: 'presentation', component: PresentationComponent },
    { path: 'depot', component: DepotComponent },
    { path: 'login', component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'panier', component: PanierComponent },
    { path: 'compte', component: CompteComponent, canActivate: [authGuard] }
];
