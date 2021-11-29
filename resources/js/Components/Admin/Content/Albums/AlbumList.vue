<template>
    <section class="album-list">
        <header>
            <div>ID</div>
            <div>Cover</div>
            <div>Title</div>
            <div>Alternative Title</div>
            <div>Artists</div>
            <div>Songs</div>
            <div>Actions</div>
        </header>
        <main>
            <div class="item" v-for="album in albums" :key="album.id">
                <div>{{ album.id }}</div>
                <div><img :src="album.cover" class="table-image-rounded" v-if="album.cover" /></div>
                <div>{{ album.title }}</div>
                <div>{{ album.alternative_title }}</div>
                <div>{{ album.artists }}</div>
                <div>{{ album.tracks.length }}</div>
                <div class="actions">
                    <OButton icon="eye" @click.native="showItem(album.id)" />
                    <OButton icon="pencil-outline" @click.native="editItem(album.id)" />
                    <OButton icon="trash-can-outline" :text="false" @click.native="deleteItem(album.id)" />
                </div>
            </div>
        </main>
    </section>
</template>

<script>
import OButton from '@/Components/Common/OButton';

export default {
    name: 'AlbumList',
    components: {
        OButton
    },
    props: {
        albums: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    methods: {
        showItem(albumId) {
            this.$inertia.get(this.$route('albums.show', {album: albumId}));
        },
        editItem(albumId) {
            this.$inertia.get(this.$route('admin.content.albums.edit', {album: albumId}));
        },
        deleteItem(albumId) {
            this.$inertia.delete(this.$route('admin.content.albums.destroy', {album: albumId}));
        }
    }
}
</script>

<style lang="scss" scoped>
.album-list {
    & header, & main > div {
        display: grid;
        grid-template-columns: 50px 70px 1fr 1fr 1fr 100px 200px;
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
