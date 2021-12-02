<template>
    <div>
        <PageHeader title="Edit a track"></PageHeader>

        <Tabs>
            <TabItem @click.native="currentTab = 0" title="General" :isActive="currentTab === 0" />
            <TabItem @click.native="currentTab = 1" :title="`Artists (${track.artists.length})`" :isActive="currentTab === 1" />
        </Tabs>

        <div class="wrapper" v-if="currentTab === 0">
            <GeneralForm
                :form="form"
                :errors="errors"
                @submit="sendGeneralForm"
            />
        </div>

        <ArtistList :artists="track.artists" v-if="currentTab === 1" />

        <hr />

        <div class="wrapper" v-if="currentTab === 1">
            <form @submit.prevent="sendAddForm">
                <select name="artist">
                    <option disabled selected>Select an artist</option>
                    <option v-for="artist in artists" :key="artist.id" :value="artist.id">{{ artist.name }}</option>
                </select>
                <OButton icon="plus" text="Add artist" />
            </form>
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
import GeneralForm from '@/Components/Admin/Content/Tracks/GeneralForm';
import ArtistList from '@/Components/Admin/Content/Tracks/ArtistList';

export default {
    name: 'AdminContentTrackEdit',
    components: {
        PageHeader,
        OButtonSubmit,
        OButton,
        Tabs,
        TabItem,
        GeneralForm,
        ArtistList
    },
    props: {
        track: Object|Boolean,
        artists: Object|Boolean,
        albums: Object|Boolean,
        errors: Object,
    },
    data() {
        return {
            currentTab: 0,
            form: this.$inertia.form({
                title: this.track.title,
                alternative_title: this.track.alternative_title ? this.track.alternative_title : null,
                secondary_title: this.track.secondary_title ? this.track.secondary_title : null,
                tags: this.track.tags ? this.track.tags : null,
                duration: this.track.duration ? this.track.duration : null,
                cover: null,
                asset: null,
            }),
        }
    },
    methods: {
        sendGeneralForm() {
            Inertia.post(this.$route('admin.content.tracks.update', {track: this.track}), {...this.form, _method: 'PUT'});
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
