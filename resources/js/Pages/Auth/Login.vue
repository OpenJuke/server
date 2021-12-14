<template>
    <div class="auth">
        <aside>
            <img src="/images/logo.svg" alt="OpenJuke Logo" />

            <div class="detail">Access your own music from everywhere!<br />Self-hosted music library - made easy!</div>

            <div v-if="$page.props.flash.message" class="alert">
                {{ $page.props.flash.message }}
            </div>

            <form @submit.prevent="submitForm">
                <OButton icon="google" text="Login via Google" />

                <div class="divider">OR</div>

                <div class="input">
                    <label for="username">Username</label>
                    <input id="username" v-model="form.name" type="text" />
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input id="password" v-model="form.password" type="password" />
                </div>

                <OButtonSubmit text="Submit" />
            </form>
        </aside>
        <main>
            <!-- Image -->
        </main>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
import OButton from '@/Components/Common/OButton';
import OButtonSubmit from '@/Components/Common/OButtonSubmit';

export default {
    name: 'AuthLogin',
    layout: false,
    components: {
        Link,
        OButton,
        OButtonSubmit,
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
    .auth {
        width: 100vw;
        height: 100vh;
        display: grid;
        grid-template-columns: 480px 1fr;

        & aside {
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: stretch;
            grid-gap: 25px;

            & img {
                height: 40px;
            }
            & .detail {
                line-height: 1.5em;
                color: rgba(255,255,255,0.4);
            }

            & .divider {
                font-size: 16px;
                color: rgba(255,255,255,0.4);
                border-bottom: 1px solid rgba(255,255,255,0.3);
                text-align: center;
                line-height: 0em;
                margin: 15px 0;
            }

            & form {
                display: flex;
                flex-direction: column;
                grid-gap: 15px;
                width: 100%;

                & .input {
                    display: grid;
                    grid-template-columns: 1fr 2fr;
                    grid-gap: 15px;

                    & input {
                        width: 100%;
                    }
                }
            }
        }
        & main {
            background: #FC3BB5;
        }
    }
    .alert {
        background: red;
        padding: 25px;
    }
</style>
