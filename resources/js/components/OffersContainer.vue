<template lang="">
    <section class="offers-container">
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
            activeOffer: -1
        }
    },

    methods: {
        onOfferClick(index) {
            this.activeOffer = index;
            this.$emit("setActiveOffer", this.activeOffer)
        }
    }
}

</script>

<style lang="scss" scoped>
    .offers-container {
        width: 100%;
        height: 100%;
        position: relative;
        margin-bottom: 1rem;

        .wrapper {
            position: absolute;
            padding: 0 1Rem;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;    
            overflow-y: auto;
        }
    }
</style>