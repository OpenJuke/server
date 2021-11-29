<template>
    <div class="page-header-user-dropdown" :class="{ 'active': active }">
        <nav>
            <div class="profile">
                <img :src="user.avatar" class="avatar" />
                <div class="name">{{ user.name }}</div>
                <div class="email">{{ user.email }}</div>
            </div>
            <section>
                <Link :href="$route('discovery.index')">
                    <span class="mdi mdi-view-dashboard"></span>
                    <div>Profile</div>
                </Link>
                <Link :href="$route('admin.users.edit', {user: user})">
                    <span class="mdi mdi-cog"></span>
                    <div>Settings</div>
                </Link>
                <Link :href="$route('logout')">
                    <span class="mdi mdi-logout-variant"></span>
                    <div>Logout</div>
                </Link>
            </section>
            <section>
                <Link :href="$route('admin.users.index')">
                    <span class="mdi mdi-account-group"></span>
                    <div>Users</div>
                </Link>
            </section>
            <section>
                <Link :href="$route('admin.content.artists.index')">
                    <span class="mdi mdi-account-music"></span>
                    <div>Artists</div>
                </Link>
                <Link :href="$route('admin.content.artists.index')">
                    <span class="mdi mdi-music"></span>
                    <div>Tracks</div>
                </Link>
                <Link :href="$route('admin.content.albums.index')">
                    <span class="mdi mdi-album"></span>
                    <div>Albums</div>
                </Link>
            </section>
        </nav>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

export default {
    name: "PageHeaderUserDropdown",
    components: {
        Link
    },
    props: {
        active: {
            type: Boolean,
            default() {
                return false;
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
.page-header-user-dropdown {
    background: rgba(0,0,0,0.3);
    backdrop-filter: blur(5px);
    position: absolute;
    z-index: 100;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 50px;
    display: none;
    justify-content: center;
    align-items: flex-start;

    &.active {
        display: flex;
    }

    & nav {
        width: 100%;
        max-width: 400px;
        display: grid;
        grid-gap: 25px;
        align-items: flex-start;

        & .profile {
            display: grid;
            justify-content: center;
            text-align: center;

            & img {
                width: 128px;
                height: 128px;
                border-radius: 200px;
                margin-bottom: 15px;
            }
            & .name {
                font-size: 22px;
                font-weight: bold;
            }
            & .email {
                color: rgba(255,255,255,0.6);
            }
        }

        & section {
            background: #222;
            border-radius: 4px;

            & a {
                background: transparent;
                display: grid;
                grid-template-columns: 24px 1fr;
                grid-gap: 10px;
                padding: 10px 25px;
                border-radius: 4px;
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
            }
        }
    }
}
</style>
