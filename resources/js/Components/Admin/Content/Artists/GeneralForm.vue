<template>
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
</template>

<script>
import OButtonSubmit from '@/Components/Common/OButtonSubmit';

export default {
    name: 'ArtistGeneralForm',
    components: {
        OButtonSubmit
    },
    props: {
        form: Object,
        errors: Object,
    },
    methods: {
        sendForm() {
            this.form.cover = this.$refs.coverFile.files[0];
            this.$emit('submit');
        }
    }
}
</script>