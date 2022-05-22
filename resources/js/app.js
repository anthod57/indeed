require('./bootstrap');

import { createApp } from 'vue'
import App from './App.vue'
import { library } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faHome, faBuilding, faCalculator, faUserPlus, faArrowRightToBracket, faEllipsisV, faSliders, faBars, faXmark, faLocationDot, faEye, faBookmark } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

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
.mount('#app')
