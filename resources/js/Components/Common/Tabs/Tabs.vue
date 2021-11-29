<template>
    <div class="tabs">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "Tabs",
}
</script>

<style lang="scss" scoped>
.tabs {
    padding: 10px;
    padding-bottom: 0px;
    border-bottom: 1px solid #222;
    display: flex;
    grid-gap: 5px;
}
</style>
