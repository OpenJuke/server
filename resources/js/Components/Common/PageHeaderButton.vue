<template>
    <div class="page-header-button" tabindex="-1">
        <span :class="'mdi mdi-' + icon"></span>
    </div>
</template>

<script>
export default {
    name: "PageHeaderButton",
    props: {
        icon: {
            type: String,
            default() {
                return "home";
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .page-header-button {
        background: rgba(252,59,181,0.15);
        color: #FC3BB5;
        font-size: 24px;
        width: 45px;
        height: 45px;
        border-radius: 100px;
        transition: 0.2s ease-in-out all;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;

        &:hover {
            background: rgba(252,59,181,0.3);
            cursor: pointer;
        }
    }
</style>