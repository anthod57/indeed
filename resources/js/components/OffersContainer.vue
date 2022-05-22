<template lang="">
    <section class="offers-container">
        <div class="header">
            <label for="sort">Trier:</label>
            <v-select v-model="sortBy" :reduce="(option) => option.id" id="sort" name="sort" :options="[
                {label: 'Plus récentes', id: 0},
                {label: 'Moins récentes', id: 1},
                {label: 'Plus populaires', id: 2},
                {label: 'Moins populaires', id: 3}
            ]"></v-select>
        </div>
        <div class="wrapper">
            <Offer v-for="(offer, index) in offers" :data="offer" :key="index" :isActive="index === activeOffer" v-on:click="onOfferClick(index)" />
        </div>
    </section>
</template>

<script>
import Offer from './Offer.vue'
export default {
    name: 'OffersContainer',
    components: {
        Offer
    },

    props: [
        'offers'
    ],

    data() {
        return {
            activeOffer: -1,
            sortBy: 0,
        }
    },

    methods: {
        onOfferClick(index) {
            this.activeOffer = index;
            this.$emit("setActiveOffer", this.activeOffer)
        },
    },

    watch: {
        sortBy: function (value) {
            this.$emit('sortOffers', value);
        }
    }
}

</script>

<style lang="scss" scoped>
    .offers-container {
        width: 100%;
        height: 100%;
        position: relative;

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin: auto;
            max-width: 800px;
            height: 40px;
            gap: .5rem;

            select {
                margin: 1rem;
                width: 100%;
                max-width: max-content;
                border-radius: 20px;
                padding: 0 0.5rem;
                height: 40px;
                font-size: 1rem;
                border: #3b3b3b 1px solid;
                min-width: min-content;
                color: black;
            }
        }

        .wrapper {
            position: absolute;
            padding: 0 1Rem;
            top: calc(40px + 1rem);
            bottom: 0;
            right: 0;
            left: 0;    
            overflow-y: auto;
        }

        
    }
</style>