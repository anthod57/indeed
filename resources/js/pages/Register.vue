<template lang="">
    <Navbar />
    <main>
        <div class="page">
            <RegisterForm></RegisterForm>
        </div>
    </main>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import RegisterForm from "../components/RegisterForm.vue";

export default {
    components: {
        Navbar,
        RegisterForm,
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
