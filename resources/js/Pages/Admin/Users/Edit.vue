<template>
    <div>
        <PageHeader title="Edit user"></PageHeader>

        <form @submit.prevent="sendForm">
            <label for="name">Name*</label>
            <input type="text" v-model="form.name" id="name" />
            <div v-if="form.errors.name">{{ form.errors.name }}</div>
            <br /><br />
            <label for="email">E-Mail*</label>
            <input type="text" v-model="form.email" id="email" />
            <div v-if="form.errors.email">{{ form.errors.email }}</div>
            <br /><br />
            <label for="password">Password*</label>
            <input type="password" v-model="form.password" id="password" />
            <div v-if="form.errors.password">{{ form.errors.password }}</div>
            <br /><br />
            <button type="submit" :disabled="form.processing">Update</button>
        </form>
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import OButton from '@/Components/Common/OButton';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'AdminUsersEdit',
    components: {
        PageHeader,
        OButton
    },
    props: {
        user: {
            type: Object|Boolean,
            default() {
                return false;
            }
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                password: null,
            }),
        }
    },
    methods: {
        sendForm() {
            Inertia.put(this.$route('admin.users.update', {user: this.user}), this.form);
        }
    }
}
</script>