<template lang="">
    <Navbar />
    <main>
        <div class="page">
            <Searchbar @changename="myName = $event"></Searchbar>
            <OffersContainer></OffersContainer>
        </div>
        <div class="sidebar">
            <Navbar />
        </div>
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
export default {
    components: {
        Navbar,
        Searchbar,
        OffersContainer
    },
    data() {
        return {
            myName: "Alex",
        };
    },
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
        width: 100%;
        margin-top: 5rem;
        padding: 0 2vw;
    }

    .sidebar {
        width: 25vw;
        height: 100%;
    }

    @media screen and (max-width: 1024px) {
        .sidebar {
            display: none;
        }

        main {
            width: 100%;
        }

        .page {
            height: calc(100% - 3rem);
            margin-top: 3rem;
        }
    }   
</style>