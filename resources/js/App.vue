<template lang="">
    <Navbar />
    <main>
        <div class="page">
            <Searchbar @setOffers="updateOffers($event)"></Searchbar>
            <OffersContainer :offers="offers" @setActiveOffer="updateActiveOffer($event)"></OffersContainer>
        </div>
        <Sidebar :offer="offers[activeOffer]" :show="showSidebar" @setSidebarShow="setSidebarShow($event)" />
    </main>
    <!-- <main>
        <Searchbar @changename="myName = $event"></Searchbar>
        <div class="test" :style="{height: myName == 'John' ? '80%' : '0px'}">
            My Name is {{ myName }}
        </div>
        <OffersContainer />
    </main> -->
</template>

<script>
import Navbar from './components/Navbar.vue';
import Searchbar from './components/Searchbar.vue';
import OffersContainer from './components/OffersContainer.vue';
import Sidebar from './components/Sidebar.vue';
import axios from 'axios';
export default {
    components: {
        Navbar, 
        Searchbar,
        OffersContainer,
        Sidebar
    },

    data() {
        return {
            offers: [],
            activeOffer: -1,
            showSidebar: false
        };
    },

    async mounted() {
        this.offers = await this.getLastOffers();
    },

    methods: {
        updateOffers(event) {
            this.offers = event;
        },

        async getLastOffers() {
            const data = axios.get('/api/offers')
            .then(response => response.data)
            .then(data => { return data })
            .catch(error => console.log(error));

            return data;
        },

        updateActiveOffer(event){
            this.activeOffer = event;
            this.showSidebar = true;
        },

        setSidebarShow(event){
            this.showSidebar = event;
        }
    }
}

</script>

<style lang="scss" scoped>
    @import '../styles/app.css';

    main {
        display: flex;
        height: 100%;
        align-items: flex-start;
        justify-content: space-between;
        width: 75vw;
        overflow: hidden;
        margin: 0;
    }

    .page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        height: calc(100% - 5rem);
        flex-grow: 1;
        margin-top: 5rem;
        padding: 0 2vw;
    }

    @media screen and (max-width: 1024px) {
        main {
            width: 100%;
        }

        .page {
            height: calc(100% - 3rem);
            margin-top: 3rem;
        }
    }   
</style>