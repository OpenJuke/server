<template>
    <div>
        <PageHeader title="Create album"></PageHeader>

        <div class="wrapper">
            <AlbumGeneralForm
                :form="form"
                :errors="errors"
                @submit="sendGeneralForm"
            />
        </div>
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import AlbumGeneralForm from '@/Components/Admin/Content/Albums/GeneralForm';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'AdminContentAlbumCreate',
    components: {
        PageHeader,
        AlbumGeneralForm
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
        sendGeneralForm() {
            Inertia.post(this.$route('admin.content.albums.store'), this.form);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
