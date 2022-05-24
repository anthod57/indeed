<template lang="">
    <Navbar />
    <main>
        <div class="page">
            <LoginForm></LoginForm>
        </div>
    </main>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import LoginForm from "../components/LoginForm.vue";

export default {
    components: {
        Navbar,
        LoginForm
    },

    methods: {
    
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
    justify-content: center;
    height: calc(100%);
    flex-grow: 1;
    padding: 0 2vw;
}

@media screen and (max-width: 1024px) {
    main {
        width: 100%;
    }
}
</style>
 