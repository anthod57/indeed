<template lang="">
    <div class="not-found">
        <h1>404 NOT FOUND</h1>
    </div>
</template>

<script>
export default {};
</script>

<style lang="css">
*,
:after,
:before {
    box-sizing: border-box;
    border: 0 solid #e2e8f0;
}

html {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji,
        Segoe UI Symbol, Noto Color Emoji;
    line-height: 1.5;
    -webkit-text-size-adjust: 100%;
}

body {
    background-color: #1a202c;
    font-family: "Nunito", sans-serif;
    margin: 0;
}

.not-found {
    display: flex;
    justify-content: center;
    min-height: 100vh;
    position: relative;
    width: 100%;
    align-items: center;
    padding-top: 0;
}

h1 {
    color: #a0aec0;
    font-weight: 500;
    font-size: 1.125rem;
}
</style>
