<template>
    <aside>
        <header>
            <Link :href="$route('index')">
                <img src="/images/logo.svg" alt="OpenJuke Logo" />
            </Link>
        </header>
        <nav>
            <Link :href="$route('discovery.index')" :class="{'active': currentUrl === 'discovery.index'}">
                <span class="mdi mdi-view-dashboard"></span>
                <div>Discovery</div>
            </Link>
            <Link :href="$route('discovery.index')" :class="{'active': currentUrl === 'discovery.index'}">
                <span class="mdi mdi-archive-music"></span>
                <div>Library</div>
            </Link>
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
    props: {
        currentUrl: {
            type: String,
            default() {
                return '';
            }
        }
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
        & nav {
            align-self: flex-start;
            display: grid;
            grid-gap: 5px;
            align-items: flex-start;
            width: calc(100% - 25px);

            & a {
                background: transparent;
                display: grid;
                grid-template-columns: 24px 1fr;
                grid-gap: 10px;
                padding: 10px 25px;
                border-top-right-radius: 50px;
                border-bottom-right-radius: 50px;
                text-decoration: none;
                align-items: center;
                color: rgba(255,255,255,0.6);
                transition: 0.2s ease-in-out all;

                & span {
                    font-size: 24px;
                }
                & div {
                    font-size: 18px;
                }

                &:hover {
                    background: rgba(255,255,255,0.07);
                    cursor: pointer;
                }

                &.active {
                    background: rgba(252,59,181,0.15);
                    color: #FC3BB5;
                }
            }
        }
    }
</style>
