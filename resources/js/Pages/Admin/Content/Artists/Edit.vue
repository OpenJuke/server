<template>
    <div>
        <PageHeader title="Create artist"></PageHeader>

        <div class="wrapper">
            <form @submit.prevent="sendForm" enctype="multipart/form-data" class="form-crud">
                <div class="input-group">
                    <label for="name">Name*</label>
                    <input type="text" v-model="form.name" id="name" />
                    <div v-if="errors && errors.name" class="error">{{ errors.name }}</div>
                </div>
                <div class="input-group">
                    <label for="alternative_name">Alternative Name</label>
                    <input type="text" v-model="form.alternative_name" id="alternative_name" />
                    <div v-if="errors && errors.alternative_name" class="error">{{ errors.alternative_name }}</div>
                </div>
                <div class="input-group">
                    <label for="cover">Cover</label>
                    <input type="file" ref="coverFile" id="cover" />
                    <div v-if="errors && errors.cover" class="error">{{ errors.cover }}</div>
                    <div class="hint">.jpg/.png file, Aspect ratio: 1 by 1</div>
                </div>
                <div class="input-actions">
                    <OButtonSubmit text="Create" icon="content-save" />
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import OButtonSubmit from '@/Components/Common/OButtonSubmit';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'AdminContentArtistEdit',
    components: {
        PageHeader,
        OButtonSubmit
    },
    props: {
        artist: {
            type: Object|Boolean,
            default() {
                return false;
            }
        },
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.artist.name,
                alternative_name: this.artist.alternative_name ? this.artist.alternative_name : null,
                cover: null
            }),
        }
    },
    methods: {
        sendForm() {
            this.form.cover = this.$refs.coverFile.files[0];
            Inertia.post(this.$route('admin.content.artists.update', {artist: this.artist}), {...this.form, _method: 'PUT'});
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
