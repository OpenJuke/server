<template>
    <div class="tab-item" :class="{ 'active': isActive }">
        {{ title }}
    </div>
</template>

<script>
export default {
    name: "Tabs",
    props: {
        isActive: {
            type: Boolean,
            default() {
                return false;
            }
        },
        title: {
            type: String,
            default() {
                return '';
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.tab-item {
    padding: 10px 25px;
    margin-bottom: -1px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background: transparent;
    color: rgba(255,255,255,0.6);
    cursor: pointer;
    border: 1px solid transparent;
    border-bottom: 0;
    transition: 0.2s ease-in-out all;

    &:hover {
        color: #fff;
    }
    &.active {
        background: #111;
        color: #fff;
        border-color: #222;
    }
}
</style>
