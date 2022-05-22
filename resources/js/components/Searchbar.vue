<template lang="">
    <section class="searchbar-container">
        <div class="searchbar">
            <input type="text" class="keywords" placeholder="Métier, mots-clés ou entreprise" v-model="keywords" v-on:keyup.enter="searchOffers()" />
            <div class="filter-button">
                <font-awesome-icon :icon="['fas', 'sliders']" />
            </div>
            <div class="search-button" v-on:click="searchOffers()">
                <font-awesome-icon :icon="['fas', 'search']" />
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
            keywords: ''
        }
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
        }
    },
}

</script>

<style lang="scss" scoped>

    .searchbar-container {
        width: 100%;
        height: 50px;
        margin: 1rem auto;
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 800px;

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
        }

        .search-button {
            cursor: pointer;
            background-color: #505DF1;
            color: #f8f8fc;
            height: 50px;
            width: 70px;
            border-radius: 0 30px 30px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        } 
    }

</style>