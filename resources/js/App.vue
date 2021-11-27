<template>
    <div class="app">
        <PageSidebar />

        <main>
            <slot />
        </main>
    </div>
</template>

<script>
import PageSidebar from '@/Components/Common/PageSidebar';

export default {
    components: {
        PageSidebar,
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