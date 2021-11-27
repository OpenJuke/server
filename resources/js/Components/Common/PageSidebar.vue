<template>
    <aside>
        <header>
            <Link :href="$route('index')">
                <img src="/images/logo.svg" alt="OpenJuke Logo" />
            </Link>
        </header>
        <nav>
            <Link :href="$route('discovery.index')">DiscoveryIndex</Link>
            <Link :href="$route('admin.users.index')">AdminUsersIndex</Link>
        </nav>
    </aside>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
    name: 'PageSidebar',
    components: {
        Link
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        }
    }
}
</script>

<style lang="scss" scoped>
    aside {
        display: grid;
        grid-template-rows: auto 1fr;

        & header {
            padding: 25px 25px;

            & img {
                height: 35px;
            }
        }
    }
</style>