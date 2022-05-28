<template lang="">
    <Navbar />
    <main>
        <div class="page">
            <PostAdForm></PostAdForm>
        </div>
    </main>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import PostAdForm from "../components/PostAdForm.vue";

export default {
    components: {
        Navbar,
        PostAdForm,
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
