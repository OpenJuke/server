<template>
    <div>
        <PageHeader title="Create artist"></PageHeader>

        <div class="wrapper">
            <ArtistGeneralForm
                :form="form"
                :errors="errors"
                @submit="sendGeneralForm"
            />
        </div>
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import ArtistGeneralForm from '@/Components/Admin/Content/Artists/GeneralForm';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'AdminContentArtistCreate',
    components: {
        PageHeader,
        ArtistGeneralForm
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                alternative_name: null,
                cover: null,
            }),
        }
    },
    methods: {
        sendGeneralForm() {
            Inertia.post(this.$route('admin.content.artists.store'), this.form);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
