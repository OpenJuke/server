<template>
    <div>
        <h1>Auth -> Login</h1>
        <Link href="/">Back</Link>

        <hr />

        <div v-if="$page.props.flash.message" class="alert">
            {{ $page.props.flash.message }}
        </div>

        <form @submit.prevent="submitForm">
            <label for="username">Username:</label>
            <input id="username" v-model="form.name" />

            <label for="password">Password:</label>
            <input id="password" v-model="form.password" type="password" />

            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
    name: 'AuthLogin',
    layout: false,
    components: {
        Link,
    },
    data() {
        return {
            form: {
                name: null,
                password: null,
            },
        }
    },
    methods: {
        submitForm: function () {
            this.$inertia.post('/auth/login', this.form);
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