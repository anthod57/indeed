import Home from './pages/Home';
import Login from './pages/Login';

export const routes = [
    // {
    //     path: '*',
    //     component: NotFound
    // },
    {
        path: '/',
        component: Home,
        name: "Home"
    },
    {
        path: '/login',
        component: Login,
        name: 'Login',

        beforeEnter: (to, from, next) => {
            if (JSON.parse(window.auth_user)) {
                return next('/')
            }

            next();
        }
    },
]