import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import NotFound from './pages/NotFound';
import PostAd from './pages/PostAd';

export const routes = [
    {
        path: '/:catchAll(.*)',
        redirect: '/404'
    },

    {
        path: '/404',
        component: NotFound,
        name: "404"
    },

    {
        path: '/',
        component: Home,
        name: "Home"
    },

    {
        path: '/login',
        component: Login,
        name: 'Login',

        // If user is logged in, redirect to home page.
        beforeEnter: (to, from, next) => {
            if (window.auth_user) {
                return next('/')
            }

            next();
        }
    },

    {
        path: '/register',
        component: Register,
        name: 'Register',

        // If user is logged in, redirect to home page.
        beforeEnter: (to, from, next) => {
            if (window.auth_user) {
                return next('/')
            }

            next();
        }
    },

    {
        path: '/publier-une-annonce',
        component: PostAd,
        name: 'PostAd',

        // If user (company) is not logged in, redirect to login page.
        beforeEnter: (to, from, next) => {
            if (window.auth_user && window.auth_user.type !== "company") {
                return next('/')
            }

            if (!window.auth_user) {
                return next({ name: 'Login', params: { defaultType: 'company', redirect: 'PostAd' } });
            }

            next();
        }
    },
]