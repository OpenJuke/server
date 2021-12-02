<template>
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
            <label for="secondary_title">Secondary Title</label>
            <input type="text" v-model="form.secondary_title" id="secondary_title" />
            <div v-if="errors && errors.secondary_title" class="error">{{ errors.secondary_title }}</div>
        </div>
        <div class="input-group">
            <label for="tags">Tags</label>
            <input type="text" v-model="form.tags" id="tags" />
            <div v-if="errors && errors.tags" class="error">{{ errors.tags }}</div>
        </div>
        <div class="input-group">
            <label for="duration">Duration</label>
            <input type="number" v-model="form.duration" id="duration" />
            <div v-if="errors && errors.duration" class="error">{{ errors.duration }}</div>
        </div>
        <div class="input-group">
            <label for="cover">Cover</label>
            <input type="file" ref="coverFile" id="cover" />
            <div v-if="errors && errors.cover" class="error">{{ errors.cover }}</div>
            <div class="hint">.jpg/.png file, Aspect ratio: 1 by 1</div>
        </div>
        <div class="input-group">
            <label for="asset">Asset</label>
            <input type="file" ref="assetFile" id="asset" />
            <div v-if="errors && errors.asset" class="error">{{ errors.asset }}</div>
            <div class="hint">.mp3 file</div>
        </div>
        <div class="input-actions">
            <OButtonSubmit text="Save" icon="content-save" />
        </div>
    </form>
</template>

<script>
import OButtonSubmit from '@/Components/Common/OButtonSubmit';

export default {
    name: 'TrackGeneralForm',
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
            this.form.asset = this.$refs.assetFile.files[0];
            this.$emit('submit');
        }
    }
}
</script>