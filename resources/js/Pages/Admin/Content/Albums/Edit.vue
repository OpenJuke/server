<template>
    <div>
        <PageHeader title="Edit an album"></PageHeader>

        <Tabs>
            <TabItem @click.native="currentTab = 0" title="General" :isActive="currentTab === 0" />
            <TabItem @click.native="currentTab = 1" :title="`Artists (${album.artists.length})`" :isActive="currentTab === 1" />
            <TabItem @click.native="currentTab = 2" :title="`Tracks (${album.tracks.length})`" :isActive="currentTab === 2" />
        </Tabs>

        <div class="wrapper" v-if="currentTab === 0">
            <AlbumGeneralForm
                :form="form"
                :errors="errors"
                @submit="sendGeneralForm"
            />
        </div>

        <ArtistList :artists="album.artists" v-if="currentTab === 1" />

        <TrackList :tracks="album.tracks" v-if="currentTab === 2" />

        <hr />

        <div class="wrapper" v-if="currentTab === 1">
            <OButton icon="plus" text="Add artist" />
        </div>

        <div class="wrapper" v-if="currentTab === 2">
            <OButton icon="plus" text="Add track" />
        </div>
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import OButtonSubmit from '@/Components/Common/OButtonSubmit';
import OButton from '@/Components/Common/OButton';
import Tabs from '@/Components/Common/Tabs/Tabs';
import TabItem from '@/Components/Common/Tabs/TabItem';
import { Inertia } from '@inertiajs/inertia';
import ArtistList from '@/Components/Admin/Content/Albums/ArtistList';
import TrackList from '@/Components/Admin/Content/Albums/TrackList';
import AlbumGeneralForm from '@/Components/Admin/Content/Albums/GeneralForm';

export default {
    name: 'AdminContentAlbumEdit',
    components: {
        PageHeader,
        OButtonSubmit,
        OButton,
        Tabs,
        TabItem,
        AlbumGeneralForm,
        ArtistList,
        TrackList
    },
    props: {
        album: {
            type: Object|Boolean,
            default() {
                return false;
            }
        },
        errors: Object,
    },
    data() {
        return {
            currentTab: 0,
            form: this.$inertia.form({
                title: this.album.title,
                alternative_title: this.album.alternative_title ? this.album.alternative_title : null,
                cover: null
            }),
        }
    },
    methods: {
        sendGeneralForm() {
            Inertia.post(this.$route('admin.content.albums.update', {album: this.album}), {...this.form, _method: 'PUT'});
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
