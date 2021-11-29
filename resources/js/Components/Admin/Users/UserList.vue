<template>
    <section class="user-list">
        <header>
            <div>ID</div>
            <div>Username</div>
            <div>Email</div>
            <div>Created</div>
            <div>Last login</div>
            <div>Actions</div>
        </header>
        <main>
            <div class="item" v-for="user in users" :key="user.id">
                <div>{{ user.id }}</div>
                <div>{{ user.name }}</div>
                <div>{{ user.email }}</div>
                <div>{{ user.created_at|moment("calendar") }}</div>
                <div>{{ user.updated_at|moment("calendar") }}</div>
                <div class="actions">
                    <OButton icon="account-edit-outline" :text="'Edit'" @click.native="editItem(user.id)" />
                    <OButton icon="trash-can-outline" :text="false" @click.native="deleteItem(user.id)" />
                </div>
            </div>
        </main>
    </section>
</template>

<script>
import OButton from '@/Components/Common/OButton';

export default {
    name: 'UserList',
    components: {
        OButton
    },
    props: {
        users: {
            type: Array,
            default() {
                return [];
            }
        }
    },
    methods: {
        editItem(userId) {
            this.$inertia.get(this.$route('admin.users.edit', {user: userId}));
        },
        deleteItem(userId) {
            this.$inertia.delete(this.$route('admin.users.destroy', {user: userId}));
        }
    }
}
</script>

<style lang="scss" scoped>
    .user-list {
        & header, & main > div {
            display: grid;
            grid-template-columns: 50px 1fr 1fr 250px 250px 200px;
            padding: 0px 20px;
        }
        & header {
            border-bottom: 1px solid #222;
            
            & > div {
                padding: 10px 20px;
                font-weight: bold;
            }
        }
        & main {
            & > div {
                transition: 0.2s ease-in-out background;

                & > div {
                    align-self: center;
                    padding: 10px 20px;
                    color: rgba(255,255,255,0.6);

                    &.actions {
                        display: flex;

                        & > * {
                            margin-right: 5px;
                        }
                    }
                }

                &:hover {
                    background: rgba(255,255,255,0.07);
                }
            }
        }
    }
</style>