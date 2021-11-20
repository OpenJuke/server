<template>
    <div>
        <h1>Auth -> Index</h1>
        <Link :href="$route('login')">Login</Link>
        <Link :href="$route('register')">Register</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
    name: 'AuthIndex',
    layout: false,
    components: {
        Link,
    }
}
</script>