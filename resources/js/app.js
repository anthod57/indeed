require('./bootstrap');

import { createApp } from 'vue'
import App from './App.vue'
import { library } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faHome, faBuilding, faCalculator, faUserPlus, faArrowRightToBracket, faEllipsisV, faSliders, faBars, faXmark, faLocationDot, faEye, faBookmark } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import store from './store'


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

createApp(App)
    .component("font-awesome-icon", FontAwesomeIcon)
    .component('v-select', vSelect)
    .use(store)
    .mount('#app');