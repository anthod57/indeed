require('./bootstrap');

import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import vSelect from 'vue-select'

import { library } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faHome, faBuilding, faCalculator, faUserPlus, faArrowRightToBracket, faEllipsisV, faSliders, faBars, faXmark, faLocationDot, faEye, faBookmark } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import 'vue-select/dist/vue-select.css';
import store from './store';
import { routes } from './routes';

axios.defaults.withCredentials = true


const icons = [
    faSearch,
    faHome,
    faBuilding,
    faCalculator,
    faUserPlus,
    faArrowRightToBracket,
    faEllipsisV,
    faSliders,
    faBars,
    faXmark,
    faLocationDot,
    faEye,
    faBookmark
];

library.add(icons);

const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach(async (to, from) => {
    store.commit("setUser", window.auth_user);
})


const app = createApp({})
    .component("font-awesome-icon", FontAwesomeIcon)
    .component('v-select', vSelect)
    .use(store)
    .use(router)
    .mount('#app');