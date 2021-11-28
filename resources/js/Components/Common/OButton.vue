<template>
    <div class="button" tabindex="-1" :class="{ 'hasIcon': icon !== false, 'hasText': text !== false}">
        <div v-if="icon" :class="'mdi mdi-' + icon"></div>
        <div v-if="text" class="text">{{ text }}</div>
    </div>
</template>

<script>
export default {
    name: "OButton",
    props: {
        icon: {
            type: String|Boolean,
            default() {
                return false;
            }
        },
        text: {
            type: String|Boolean,
            default() {
                return false;
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .button {
        background: rgba(255,255,255,0.07);
        color: #fff;
        font-size: 14px;
        height: 30px;
        border-radius: 5px;
        transition: 0.2s ease-in-out all;
        display: inline-grid;
        user-select: none;
        align-items: center;

        &.hasText {
            padding: 0px 15px;
        }
        &.hasIcon {
            padding: 0px 15px;

            & .mdi {
                font-size: 18px;
            }
            &.hasText {
                grid-template-columns: auto 1fr;
                grid-gap: 8px;
            }
        }
        &:hover {
            background: rgba(255,255,255,0.14);
            cursor: pointer;
        }
    }
</style>