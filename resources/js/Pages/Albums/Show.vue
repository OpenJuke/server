<template>
    <div>
        <PageHeader :album="album">
            <PageHeaderButton icon="plus-box-multiple" @click.native="addToQueue()" />
        </PageHeader>

        <TrackList :tracks="album.tracks" />

        <div class="wrapper">
            <OButton icon="plus" text="Add Track" @click="$inertia.get($route('albums.add'))" />
        </div>
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import PageHeaderButton from '@/Components/Common/PageHeaderButton';
import TrackList from '@/Components/Albums/TrackList';
import OButton from '@/Components/Common/OButton';

export default {
    name: 'AlbumShow',
    components: {
        PageHeader,
        PageHeaderButton,
        OButton,
        TrackList
    },
    props: {
        album: {
            type: Object|Boolean,
            default() {
                return false;
            }
        },
    },
    data() {
        return {
        }
    },
    methods: {
        addToQueue() {
            this.album.tracks.forEach(track => {
                this.$root.$emit('addToQueue', track.id);
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
