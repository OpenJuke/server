<template>
    <div>
        <PageHeader title="Create user"></PageHeader>

        <div class="wrapper">
            <form @submit.prevent="sendForm">
                <div class="input-group">
                    <label for="name">Username*</label>
                    <input type="text" v-model="form.name" id="name" />
                    <div v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="input-group">
                    <label for="email">E-Mail*</label>
                    <input type="text" v-model="form.email" id="email" />
                    <div v-if="form.errors.email">{{ form.errors.email }}</div>
                </div>
                <div class="input-group">
                    <label for="password">Password*</label>
                    <input type="password" v-model="form.password" id="password" />
                    <div v-if="form.errors.password">{{ form.errors.password }}</div>
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
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                password: null,
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
