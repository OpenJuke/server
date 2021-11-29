<template>
    <div class="app">
        <PageSidebar
            :currentUrl="$route().current()"
        />

        <main>
            <slot />
        </main>

        <Player :queue="playerQueue" />
    </div>
</template>

<script>
import PageSidebar from '@/Components/Common/PageSidebar';
import Player from '@/Components/Common/Player/Player';

export default {
    components: {
        PageSidebar,
        Player
    },
    data() {
        return {
            playerQueue: []
        }
    },
    mounted() {
        this.$root.$on('playTrack', (trackId) => {
            this.playerQueue = [];
            this.playerQueue.push(trackId);
        });
        this.$root.$on('addToQueue', (trackId) => {
            this.playerQueue.push(trackId);
        });
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        }
    }
}
</script>

<style lang="scss" scoped>
.app {
    width: 100%;
    height: 100%;
    overflow: hidden;
    display: grid;
    grid-template-columns: 300px 1fr;

    & aside {
        background: #111111;
        border-right: 1px solid #222222;
    }
}
</style>
