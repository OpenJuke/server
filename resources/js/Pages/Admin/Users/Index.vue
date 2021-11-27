<template>
    <div>
        <PageHeader title="Users">
            <PageHeaderButton icon="plus" @click.native="$inertia.get($route('admin.users.create'))" />
        </PageHeader>

        <UserList :users="users" />
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import PageHeaderButton from '@/Components/Common/PageHeaderButton';
import UserList from '@/Components/Users/UserList';

export default {
    name: 'AdminUsersIndex',
    props: {
        users: {
            type: Array,
            default() {
                return []
            }
        }
    },
    components: {
        PageHeader,
        PageHeaderButton,
        UserList
    },
}
</script>

<style lang="scss" scoped>

</style>