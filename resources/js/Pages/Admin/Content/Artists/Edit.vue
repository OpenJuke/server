<template>
    <div>
        <PageHeader title="Create artist"></PageHeader>

        <div class="wrapper">
            <form @submit.prevent="sendForm">
                <div class="input-group">
                    <label for="name">Name*</label>
                    <input type="text" v-model="form.name" id="name" />
                    <div v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="input-group">
                    <label for="alternative_name">Alternative Name</label>
                    <input type="text" v-model="form.alternative_name" id="alternative_name" />
                    <div v-if="form.errors.alternative_name">{{ form.errors.alternative_name }}</div>
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
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.artist.name,
                alternative_name: this.artist.alternative_name,
            }),
        }
    },
    methods: {
        sendForm() {
            Inertia.post(this.$route('admin.content.artists.store'), this.form);
        }
    }
}
</script>

<style lang="scss" scoped>
form {
    display: grid;
    grid-gap: 15px;
    max-width: 600px;

    & .input-group {
        display: grid;
        grid-template-columns: 150px 1fr;
        grid-gap: 15px;
        align-items: center;

        & label {
            color: rgba(255,255,255,0.6);
        }
    }
    & .input-actions {
        display: flex;
        justify-content: flex-end;
    }
}
</style>
