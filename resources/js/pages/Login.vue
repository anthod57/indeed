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
        LoginForm,
    },

    methods: {},
};
</script>

<style lang="scss" scoped>
main {
    width: 75vw;
}

.page {
    align-items: center;
    justify-content: center;
    height: 100%;
    margin-top: 0;
}
</style>
