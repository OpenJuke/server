<template>
    <div>
        <PageHeader title="Create user"></PageHeader>

        <div class="wrapper">
            <form @submit.prevent="sendForm" enctype="multipart/form-data" class="form-crud">
                <div class="input-group">
                    <label for="name">Username*</label>
                    <input type="text" v-model="form.name" id="name" />
                    <div v-if="errors && errors.name" class="error">{{ errors.name }}</div>
                </div>
                <div class="input-group">
                    <label for="email">E-Mail*</label>
                    <input type="text" v-model="form.email" id="email" />
                    <div v-if="errors && errors.email" class="error">{{ errors.email }}</div>
                </div>
                <div class="input-group">
                    <label for="password">Password*</label>
                    <input type="password" v-model="form.password" id="password" />
                    <div v-if="errors && errors.password" class="error">{{ errors.password }}</div>
                </div>
                <div class="input-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" ref="avatarFile" id="avatar" />
                    <div v-if="errors && errors.avatar" class="error">{{ errors.avatar }}</div>
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
    name: 'AdminUsersCreate',
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
                name: null,
                email: null,
                password: null,
                avatar: null,
            }),
        }
    },
    methods: {
        sendForm() {
            Inertia.post(this.$route('admin.users.store'), this.form);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
