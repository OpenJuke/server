<template>
    <header>
        <div class="meta" :class="{ 'meta-album': album }">
            <h1 v-if="!album">{{ title }}</h1>
            <img :src="album.cover" v-if="album" class="album-cover" />
            <div v-if="album">
                <h1>{{ album.title }}</h1>
                <h2 v-if="album.alternative_title">{{ album.alternative_title }}</h2>
                <span>{{ album.tracks.length }} Tracks</span>
            </div>
            <div class="actions">
                <slot></slot>
            </div>
        </div>
        <form class="search" @submit.prevent="sendSearchForm">
            <input type="text" name="q" placeholder="Search for Artists, tracks or albums..." />
        </form>
        <div @click="toggleUserDropdown">
            <div class="avatar" :style="'background-image: url(' + user.avatar + ')'" v-if="user.avatar"></div>
            <div class="no-avatar" v-if="!user.avatar">
                <span class="mdi mdi-account-circle-outline"></span>
            </div>

            <PageHeaderUserDropdown :active="isUserDropdownActive" />
        </div>
    </header>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue';
import PageHeaderUserDropdown from "@/Components/Common/PageHeaderUserDropdown";

export default {
    name: 'PageHeader',
    components: {
        Link,
        PageHeaderUserDropdown
    },
    props: {
        title: {
            type: String,
            default() {
                return "";
            }
        },
        album: {
            type: Object|Boolean,
            default() {
                return false;
            }
        },
    },
    data() {
        return {
            isUserDropdownActive: false
        }
    },
    methods: {
        sendSearchForm() {

        },
        toggleUserDropdown(e) {
            console.log(e);

            this.isUserDropdownActive = !this.isUserDropdownActive;
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
    header {
        border-bottom: 1px solid #222;
        padding: 25px;
        display: grid;
        grid-template-columns: 1fr auto auto;
        grid-gap: 15px;

        & .meta {
            display: grid;
            grid-template-columns: auto 1fr;
            grid-gap: 15px;
            align-items: center;

            &.meta-album {
                grid-template-columns: auto auto 1fr;

                & .album-cover {
                    width: 100px;
                    height: 100px;
                    border-radius: 8px;
                }
                & div {
                    align-self: flex-end;
                    display: grid;
                    grid-gap: 5px;

                    & h1 {
                        margin: 0;
                        font-size: 22px;
                    }
                    & h2 {
                        margin: 0;
                        font-size: 18px;
                        font-weight: normal;
                    }
                    & span {
                        color: rgba(255,255,255,0.6);
                    }
                }
            }
            & h1 {
                margin: 0;
                font-size: 22px;

                & .actions {
                    display: flex;
                    justify-content: center;
                }
            }
        }
        & .search {
            & input {
                font-family: 'Source Sans Pro', sans-serif;
                width: 300px;
                padding: 13px 20px;
                font-size: 16px;
                border-radius: 100px;
                background: rgba(255,255,255,0.07);
                color: #fff;
                border: 0;
                transition: 0.2s ease-in-out background;

                &:hover {
                    background: rgba(255,255,255,0.14);
                    cursor: pointer;
                }
            }
        }
        & .avatar, & .no-avatar {
            width: 45px;
            height: 45px;
            border-radius: 100px;
            background-position: center;
            background-size: cover;
            cursor: pointer;
        }
        & .no-avatar {
            background: rgba(255,255,255,0.14);
            color: #fff;
            font-size: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
</style>
