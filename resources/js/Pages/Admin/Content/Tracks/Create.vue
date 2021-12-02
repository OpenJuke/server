<template>
    <div>
        <PageHeader title="Create track"></PageHeader>

        <div class="wrapper">
            <GeneralForm
                :form="form"
                :errors="errors"
                @submit="sendGeneralForm"
            />
        </div>
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import GeneralForm from '@/Components/Admin/Content/Tracks/GeneralForm';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'AdminContentTrackCreate',
    components: {
        PageHeader,
        OButtonSubmit,
        GeneralForm,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: null,
                alternative_title: null,
                secondary_title: null,
                tags: null,
                duration: null,
                cover: null,
                asset: null,
            }),
        }
    },
    methods: {
        sendGeneralForm() {
            Inertia.post(this.$route('admin.content.tracks.store'), this.form);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
