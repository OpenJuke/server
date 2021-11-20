<template>
    <div>
        <h1>Auth -> Register</h1>
        <Link href="/">Back</Link>

        <hr />

        <div v-if="$page.props.flash.message" class="alert">
            {{ $page.props.flash.message }}
        </div>

        <form @submit.prevent="submitForm">
            <label for="username">Username:</label>
            <input id="username" v-model="form.name" />

            <label for="email">Email:</label>
            <input id="email" v-model="form.email" />

            <label for="password">Password:</label>
            <input id="password" v-model="form.password" type="password" />

            <label for="passwordAgain">Password (Again):</label>
            <input id="passwordAgain" v-model="passwordAgain" type="password" />

            <strong v-if="isPasswordSame === false">Passwords are not the same</strong>

            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
    name: 'AuthRegister',
    layout: false,
    components: {
        Link,
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
            },
            passwordAgain: null,
            isPasswordSame: null,
        }
    },
    methods: {
        submitForm: function () {
            this.isPasswordSame = this.form.password === this.passwordAgain;
            if(!this.isPasswordSame) return;
            
            this.$inertia.post('/auth/register', this.form);
        }
    }
}
</script>

<style lang="scss" scoped>
    .alert {
        background: red;
        padding: 25px;
    }
</style>