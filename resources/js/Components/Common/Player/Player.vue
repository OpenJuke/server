<template>
    <div class="player" v-if="queue.length > 0">
        PLAYER {{ queue }}
    </div>
</template>

<script>
export default {
    name: "Player",
    props: {
        queue: {
            type: Array,
            default() {
                return [];
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.player {
    background: red;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
}
</style>
