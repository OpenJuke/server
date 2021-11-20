<template>
    <div class="app">
        <aside>
            <h1>OpenJuke</h1>
            <nav>
                <Link :href="$route('discovery.index')">DiscoveryIndex</Link>
            </nav>
        </aside>
        <main>
            <slot />
        </main>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
    components: {
        Link,
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
        background: #fff;
    }
}
</style>