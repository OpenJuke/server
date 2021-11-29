<template>
    <div>
        <PageHeader title="Create album"></PageHeader>

        <div class="wrapper">
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
    name: 'AdminContentAlbumCreate',
    components: {
        PageHeader,
        OButtonSubmit
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: null,
                alternative_title: null,
                cover: null,
            }),
        }
    },
    methods: {
        sendForm() {
            this.form.cover = this.$refs.coverFile.files[0];
            Inertia.post(this.$route('admin.content.albums.store'), this.form);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
