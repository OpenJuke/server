<template>
    <section class="user-list">
        <header>
            <div>ID</div>
            <div>Name</div>
            <div>Alternative Name</div>
            <div>Songs</div>
            <div>Albums</div>
            <div>Actions</div>
        </header>
        <main>
            <div class="item" v-for="artist in artists" :key="artist.id">
                <div>{{ artist.id }}</div>
                <div>{{ artist.name }}</div>
                <div>{{ artist.alternative_name }}</div>
                <div>{{ artist.tracks.length }}</div>
                <div>{{ artist.albums.length }}</div>
                <div class="actions">
                    <OButton icon="account-edit-outline" :text="'Edit'" @click.native="editItem(artist.id)" />
                    <OButton icon="trash-can-outline" :text="false" @click.native="deleteItem(artist.id)" />
                </div>
            </div>
        </main>
    </section>
</template>

<script>
import OButton from '@/Components/Common/OButton';

export default {
    name: 'ArtistList',
    components: {
        OButton
    },
    props: {
        artists: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    methods: {
        editItem(artistId) {
            this.$inertia.get(this.$route('admin.content.artists.edit', {artist: artistId}));
        },
        deleteItem(artistId) {
            this.$inertia.delete(this.$route('admin.content.artists.destroy', {artist: artistId}));
        }
    }
}
</script>

<style lang="scss" scoped>
.user-list {
    & header, & main > div {
        display: grid;
        grid-template-columns: 50px 1fr 1fr 100px 100px 200px;
        padding: 0px 20px;
    }
    & header {
        border-bottom: 1px solid #222;

        & > div {
            padding: 10px 20px;
            font-weight: bold;
        }
    }
    & main {
        & > div {
            transition: 0.2s ease-in-out background;

            & > div {
                align-self: center;
                padding: 10px 20px;
                color: rgba(255,255,255,0.6);

                &.actions {
                    display: flex;

                    & > * {
                        margin-right: 5px;
                    }
                }
            }

            &:hover {
                background: rgba(255,255,255,0.07);
            }
        }
    }
}
</style>
