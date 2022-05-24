<template lang="">
    <Navbar />
    <main>
        <div
            v-bind:class="{
                page: !searchBarFocused,
                'page search-bar-focused': searchBarFocused,
            }"
        >
            <Searchbar
                @setOffers="updateOffers($event)"
                @focused="searchBarFocused = $event"
            ></Searchbar>
            <OffersContainer
                :offers="offers"
                @setActiveOffer="updateActiveOffer($event)"
                @sortOffers="sortOffers($event)"
            ></OffersContainer>
        </div>
        <Sidebar
            :offer="offers[activeOffer]"
            :show="showSidebar"
            @setSidebarShow="setSidebarShow($event)"
        />
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
                const keywordsArray =
                    this.$store.getters.getCurrentSearchInput.split(" ");

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
                    this.offers = this.offers.sort(
                        (a, b) =>
                            moment(b.updated_at).unix() -
                            moment(a.updated_at).unix()
                    );
                    break;

                case 1: // Oldest
                    this.offers = this.offers.sort(
                        (a, b) =>
                            moment(a.updated_at).unix() -
                            moment(b.updated_at).unix()
                    );
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
@import "../../styles/app.css";

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
        height: 100%;
        margin-top: 0;
        transition: 0.5s all;

        &.search-bar-focused {
            margin-top: 3.5rem;
        }
    }
}
</style>
