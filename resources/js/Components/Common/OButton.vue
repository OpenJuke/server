<template>
    <div class="button" tabindex="-1">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "OButton",
}
</script>

<style lang="scss" scoped>
    .button {
        background: rgba(255,255,255,0.07);
        color: #fff;
        font-size: 14px;
        padding: 7px 15px;
        border-radius: 5px;
        transition: 0.2s ease-in-out all;
        display: inline-block;
        user-select: none;

        &:hover {
            background: rgba(255,255,255,0.14);
            cursor: pointer;
        }
    }
</style>