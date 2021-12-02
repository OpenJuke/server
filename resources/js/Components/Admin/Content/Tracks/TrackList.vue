<template>
    <section class="track-list">
        <header>
            <div>ID</div>
            <div>Cover</div>
            <div>Title</div>
            <div>Alternative Title</div>
            <div>Secondary Title</div>
            <div>Artists</div>
            <div>Album</div>
            <div>Duration</div>
            <div>Actions</div>
        </header>
        <main>
            <div class="item" v-for="track in tracks" :key="track.id">
                <div>{{ track.id }}</div>
                <div><img :src="track.cover" class="table-image-rounded" v-if="track.cover" /></div>
                <div>{{ track.title }}</div>
                <div>{{ track.alternative_title }}</div>
                <div>{{ track.secondary_title }}</div>
                <div>{{ getArtists(track.artists) }}</div>
                <div>{{ track.album ? track.album.title : '' }}</div>
                <div>{{ track.duration }}</div>
                <div class="actions">
                    <OButton icon="eye" @click.native="showItem(track.id)" />
                    <OButton icon="pencil-outline" @click.native="editItem(track.id)" />
                    <OButton icon="trash-can-outline" :text="false" @click.native="deleteItem(track.id)" />
                </div>
            </div>
        </main>
    </section>
</template>

<script>
import OButton from '@/Components/Common/OButton';

export default {
    name: 'TrackList',
    components: {
        OButton
    },
    props: {
        tracks: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    methods: {
        showItem(trackId) {
            this.$inertia.get(this.$route('tracks.show', {track: trackId}));
        },
        editItem(trackId) {
            this.$inertia.get(this.$route('admin.content.tracks.edit', {track: trackId}));
        },
        deleteItem(trackId) {
            this.$inertia.delete(this.$route('admin.content.tracks.destroy', {track: trackId}));
        },
        getArtists(artists) {
            let artistNames = [];

            artists.forEach(artist => {
                artistNames.push(artist.name);
            });

            return artistNames.join(", ");
        }
    },
}
</script>

<style lang="scss" scoped>
.track-list {
    & header, & main > div {
        display: grid;
        grid-template-columns: 50px 70px 1fr 1fr 1fr 1fr 1fr 100px 200px;
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
