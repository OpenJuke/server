<template>
    <div>
        <PageHeader title="Edit an album"></PageHeader>

        <Tabs>
            <TabItem @click.native="currentTab = 0" title="General" :isActive="currentTab === 0" />
            <TabItem @click.native="currentTab = 1" title="Artists" :isActive="currentTab === 1" />
        </Tabs>

        <div class="wrapper" v-if="currentTab === 0">
            <form @submit.prevent="sendForm" enctype="multipart/form-data" class="form-crud">
                <div class="input-group">
                    <label for="title">Title*</label>
                    <input type="text" v-model="form.title" id="title" />
                    <div v-if="errors && errors.title" class="error">{{ errors.title }}</div>
                </div>
                <div class="input-group">
                    <label for="alternative_title">Alternative Title</label>
                    <input type="text" v-model="form.alternative_title" id="alternative_title" />
                    <div v-if="errors && errors.alternative_title" class="error">{{ errors.alternative_title }}</div>
                </div>
                <div class="input-group">
                    <label for="cover">Cover</label>
                    <input type="file" ref="coverFile" id="cover" />
                    <div v-if="errors && errors.cover" class="error">{{ errors.cover }}</div>
                    <div class="hint">.jpg/.png file, Aspect ratio: 1 by 1</div>
                </div>
                <div class="input-actions">
                    <OButtonSubmit text="Save" icon="content-save" />
                </div>
            </form>
        </div>

        <ArtistList :artists="album.artists" v-if="currentTab === 1" />

        <hr />

        <div class="wrapper" v-if="currentTab === 1">
            <OButton icon="plus" text="Add artist" />
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

export default {
    name: 'AdminContentAlbumEdit',
    components: {
        PageHeader,
        OButtonSubmit,
        OButton,
        Tabs,
        TabItem,
        ArtistList
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
        sendForm() {
            this.form.cover = this.$refs.coverFile.files[0];
            Inertia.post(this.$route('admin.content.albums.update', {album: this.album}), {...this.form, _method: 'PUT'});
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
