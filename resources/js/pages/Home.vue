<template lang="">
    <Navbar />
    <main>
        <div
            v-bind:class="{
                page: !searchBarFocused,
                'page search-bar-focused': searchBarFocused,
            }"
        >
            <Searchbar @setOffers="updateOffers($event)" @focused="searchBarFocused = $event"></Searchbar>
            <OffersContainer :offers="offers" @setActiveOffer="updateActiveOffer($event)" @sortOffers="sortOffers($event)"></OffersContainer>
        </div>
        <Sidebar :offer="offers[activeOffer]" :show="showSidebar" @setSidebarShow="setSidebarShow($event)" />
    </main>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import Searchbar from "../components/Searchbar.vue";
import OffersContainer from "../components/OffersContainer.vue";
import Sidebar from "../components/Sidebar.vue";
import axios from "axios";
import moment from "moment";

export default {
    components: {
        Navbar,
        Searchbar,
        OffersContainer,
        Sidebar,
    },

    props: ["user"],

    data() {
        return {
            offers: [],
            activeOffer: -1,
            showSidebar: false,
            selectedFilter: 0,
            searchBarFocused: false,
        };
    },

    async mounted() {
        this.offers = await this.getLastOffers();
        this.sortOffers(this.selectedFilter);
    },

    methods: {
        updateOffers(event) {
            this.offers = event;
            this.sortOffers(this.selectedFilter);
        },

        async getLastOffers() {
            // Get offers based on user last search keywords if there are any, else get last offers. (USING VUEX PERSISTANT STORE)
            if (this.$store.getters.getCurrentSearchInput) {
                const keywordsArray = this.$store.getters.getCurrentSearchInput.split(" ");

                const data = await axios
                    .request({
                        method: "GET",
                        url: "/api/offers",
                        params: {
                            keywords: keywordsArray,
                        },
                    })
                    .then((response) => response.data)
                    .then((data) => {
                        return data;
                    })
                    .catch((error) => console.log(error));

                return data;
            } else {
                const data = await axios
                    .get("/api/offers")
                    .then((response) => response.data)
                    .then((data) => {
                        return data;
                    })
                    .catch((error) => console.log(error));

                return data;
            }
        },

        updateActiveOffer(event) {
            this.activeOffer = event;
            this.showSidebar = true;
        },

        setSidebarShow(event) {
            this.showSidebar = event;
        },

        sortOffers(value) {
            this.selectedFilter = value;

            switch (value) {
                case 0: // Newest
                    this.offers = this.offers.sort((a, b) => moment(b.created_at).unix() - moment(a.created_at).unix());
                    break;

                case 1: // Oldest
                    this.offers = this.offers.sort((a, b) => moment(a.created_at).unix() - moment(b.created_at).unix());
                    break;

                case 2: // Most viewed
                    this.offers = this.offers.sort((a, b) => b.views - a.views);
                    break;

                case 3: // Least viewed;
                    this.offers = this.offers.sort((a, b) => a.views - b.views);
                    break;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@media screen and (max-width: 1024px) {
    .page {
        &.search-bar-focused {
            margin-top: 3.5rem;
        }
    }
}
</style>
