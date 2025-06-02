import { HttpInterceptorFn } from '@angular/common/http';

export const authInterceptor: HttpInterceptorFn = (req, next) => {
  let Req1 = req.clone();

  if (localStorage.getItem("token")) {
    Req1 = req.clone({
      headers: req.headers.set('Authorization', `Bearer ${window.localStorage.getItem("token")}`),
    });
  }
  return next(Req1);
};
