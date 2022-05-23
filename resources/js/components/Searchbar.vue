<template lang="">
    <section class="searchbar-container">
        <div v-bind:class="{'searchbar': !searchbarFocused, 'searchbar focused': searchbarFocused}">
            <input type="text" class="keywords" placeholder="Métier, mots-clés ou entreprise" v-model="keywords" v-on:keyup.enter="searchOffers()"  v-on:focus="handleSearchbarFocus(true)" v-on:blur="handleSearchbarFocus(false)"/>
            <div class="filter-button">
                <font-awesome-icon :icon="['fas', 'sliders']" />
            </div>
            <div class="search-button" v-on:click="searchOffers()">
                <font-awesome-icon :icon="['fas', 'search']" />
            </div>
            <div v-bind:class="{'filter-container show': showFilters, 'filter-container': !showFilters}">
                <input type="text" placeholder="Entreprise">

                <v-select v-model="sortBy" :reduce="(option) => option.id" id="sort" name="sort" :options="[
                    {label: 'CDD', id: 0},
                    {label: 'CDI', id: 1},
                    {label: 'Alternance', id: 2},
                    {label: 'Stage', id: 3}
                ]"></v-select>

                <input type="text" placeholder="Ville"> 
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
export default {
    name: 'Searchbar',

    data() {
        return {
            keywords: '',
            showFilters: false,
            searchbarFocused: false
        }
    },

    mounted() {
        this.keywords = this.$store.getters.getCurrentSearchInput;
    },

    methods: {
        async searchOffers() {
            const keywordsArray = this.keywords.split(' ');

            const data = await axios.request({
                method: 'GET',
                url: '/api/offers',
                params: {
                    keywords: keywordsArray
                }
            })
            .then((response) => response.data)
            .then((data) => { return data })
            .catch(error => console.log(error));

            this.$emit("setOffers", data);
            this.$store.commit("setCurrentSearchInput", this.keywords);
        },
        
        handleSearchbarFocus(focused) {
            this.$emit('focused', focused)
            this.searchbarFocused = focused;
        },
    },
}

</script>

<style lang="scss">

    .searchbar-container {
        width: 100%;
        height: 50px;
        margin: 1rem auto;
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 800px;
        position: relative;

        .searchbar {
            background-color: #f8f8fc;
            border-radius: 30px;
            height: 50px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 5px 5px #0000001a;

            input {
                padding: 0.5rem 1rem;
                background: transparent;
            }

            .keywords {
                width: 100%;
                height: 100%;
                background-color: transparent;
            }
        }

        .filter-button {
            height: 50px;
            width: 50px;
            background-color: transparent;
            color: #4D484E;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            flex-shrink: 0;
        }

        .search-button {
            cursor: pointer;
            background-color: #505DF1;
            color: #f8f8fc;
            height: 50px;
            width: 60px;
            border-radius: 0 30px 30px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        } 

        .filter-container {
            background-color: #f8f8fc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            width: 0px;
            transition: 0.5s all;
            right: 110px;
            height: 100%;
            border-radius: 30px 0 0 30px;
            gap: 0.5rem;
            overflow: hidden;
            opacity: 0;

            &.show {
                padding: 0.5rem 1rem;
                opacity: 1;
                overflow: unset;
                width: calc(100% - 110px);
            }

            input {
                border-right: 1px solid rgba(164, 164, 171, 0.50);

                &:last-child {
                    border: none;
                }
            }

            .v-select {
                border-right: 1px solid rgba(164, 164, 171, 0.50);
                z-index: 5;

                input {
                    padding: 0;
                    height: 23px;
                    width: 100% !important;
                }
            }

            .vs__dropdown-toggle {
                z-index: 2;
                background-color: #f8f8fc !important;
                border: none !important;
                border-radius: 20px !important;
                padding: 0 0.5rem !important;
                padding-bottom: 4px !important;
            }

            .vs__selected-options {
                justify-content: flex-start;
                align-items: center;
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .searchbar-container {
            .searchbar {
                margin-left: calc(50px + 1rem);
                transition: 0.6s all;
                width: 100%;

                &.focused {
                    margin-left: 0;
                }
            }
        }
    }

</style>