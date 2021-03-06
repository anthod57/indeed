<template lang="">
    <div
        v-bind:class="{
            'sidebar-container show': show,
            'sidebar-container': !show,
        }"
    >
        <div class="close-button" v-on:click="handleSidebar()">
            <font-awesome-icon class="icon" :icon="['fas', 'xmark']" />
        </div>
        <div class="sidebar-wrapper" v-if="offer">
            <div class="header">
                <div class="company-picture">
                    <img ref="companyPicture" :src="'/images/default.png'" @error="$event.target.src = '/images/default.png'" />
                </div>
                <h3>{{ offer.title }}</h3>
                <div class="row">
                    <span>{{ offer.company }}</span>
                    <span>{{ offer.location }}</span>
                </div>
                <span
                    ><b>{{ offer.salary }}€ / an</b></span
                >
                <button>Postuler</button>
            </div>
            <hr />
            <div class="description">
                {{ offer.description }}
                {{ offer.description }}
                {{ offer.description }}
                {{ offer.description }}
                {{ offer.description }}
                {{ offer.description }}
                {{ offer.description }}
                {{ offer.description }}
            </div>
            <hr />
            <div class="meta-data">
                {{ getRelativeTime(offer.created_at) }}
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    name: "Sidebar",
    props: ["offer", "show"],

    methods: {
        getRelativeTime(time) {
            return moment(time).locale("fr").fromNow(); // Ex: Il y a 6 heures | Il y a 2 jours.
        },

        handleSidebar() {
            this.$emit("setSidebarShow", !this.show);
        },
    },

    watch: {
        offer: function (value) {
            this.$nextTick(() => {
                this.$refs.companyPicture.src = `/storage/images/companies/${this.offer.postedBy}.png`;
            });
        },
    },
};
</script>

<style lang="scss" scoped>
.sidebar-container {
    background-color: #f8f8fc;
    height: 100%;
    right: -100%;
    width: 0;
    color: black;
    position: relative;
    transition: 0.25s all ease-in-out;
    overflow-y: scroll;

    &.show {
        right: 0;
        width: 25vw;
    }

    .close-button {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #505df1;
        cursor: pointer;
    }

    hr {
        background-color: #a4a4ab80;
        width: 100%;
        height: 1px;
        margin: 1rem;
    }

    .sidebar-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        height: auto;
        padding: 1rem 2vw;
        margin-top: 5rem;
    }

    .header {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        gap: 2px;

        .company-picture {
            width: 33%;
            min-width: 25px;
            max-width: 300px;
            aspect-ratio: 1/1;
            border-radius: 20px;
            overflow: hidden;
            margin: 1rem;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }

        h3 {
            font-weight: 700;
            font-size: 1.5rem;
            color: #1421b5;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            color: #5d618a;
        }
    }

    .meta-data {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }
}

@media screen and (max-width: 1024px) {
    .sidebar-container {
        z-index: 5;
        top: 0;
        right: -100%;
        width: 0;
        position: absolute;
        overflow-x: hidden;

        &.show {
            width: 100%;
        }

        .sidebar-wrapper {
            margin-top: 1rem;
        }
    }
}

button {
    cursor: pointer;
    width: 100%;
    padding: 1rem 2rem;
    border-radius: 20px;
    background-color: rgba(153, 167, 237, 1);
    background-image: linear-gradient(90deg, transparent 0%, rgba(80, 93, 241, 1) 80%);
    color: white;
    font-weight: 600;
    font-size: 1rem;
    max-width: 300px;
    transition: 0.25s all;
    margin: 0.5rem;
}

button:active {
    background-color: rgba(80, 93, 241, 1);
}
</style>
