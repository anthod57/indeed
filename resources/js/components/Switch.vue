<template lang="">
    <div class="switch">
        <div v-bind:class="{ 'selector left': selectorSide === -1, 'selector right': selectorSide === 1 }"></div>
        <div class="container">
            <div v-on:click="switchValue(leftValue.value, -1)" v-bind:class="{ 'left selected': selectorSide === -1, left: selectorSide === 1 }">
                {{ leftValue.label }}
            </div>
            <div v-on:click="switchValue(rightValue.value, 1)" v-bind:class="{ 'right selected': selectorSide === 1, right: selectorSide === -1 }">
                {{ rightValue.label }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Switch",
    props: ["rightValue", "leftValue"],

    data() {
        return {
            currentValue: "",
            selectorSide: -1,
        };
    },

    mounted() {
        this.currentValue = this.leftValue.value;
        this.$emit("update:modelValue", this.currentValue);
    },

    methods: {
        switchValue(value, side) {
            this.currentValue = value;
            this.selectorSide = side;

            this.$emit("update:modelValue", this.currentValue);
        },
    },
};
</script>

<style lang="scss" scoped>
.switch {
    width: 200px;
    height: 40px;
    background-color: #f8f8fc;
    border: #a4a4ab 1px solid;
    box-shadow: 0px 0px 4px rgb(165 165 165 / 50%);
    position: relative;
    overflow: hidden;
    padding: 6px;
    border-radius: 20px;

    .container {
        display: flex;
        height: 100%;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        text-align: center;

        .right,
        .left {
            z-index: 1;
            width: 50%;
            cursor: pointer;
            color: black;
            transition: 0.5s all;

            &.selected {
                color: #f8f8fc;
            }
        }
    }

    .selector {
        z-index: 0;
        position: absolute;
        background-color: #505df1;
        top: 0;
        bottom: 0;
        left: 0;
        width: 50%;
        transition: 0.5s all;

        &.right {
            transform: translate(100%, 0);
            border-radius: 0 20px 20px 0;
        }

        &.left {
            border-radius: 20px 0 0 20px;
            transform: translate(0%, 0);
        }
    }
}
</style>
