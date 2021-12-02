<template>
    <div>
        <PageHeader title="Edit an artist"></PageHeader>

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
    name: 'AdminContentArtistEdit',
    components: {
        PageHeader,
        ArtistGeneralForm
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
        sendGeneralForm() {
            Inertia.post(this.$route('admin.content.artists.update', {artist: this.artist}), {...this.form, _method: 'PUT'});
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
