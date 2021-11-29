<template>
    <div>
        <PageHeader title="Albums">
            <PageHeaderButton icon="plus" @click.native="$inertia.get($route('admin.content.albums.create'))" />
        </PageHeader>

        <AlbumList :albums="albums" />
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import PageHeaderButton from '@/Components/Common/PageHeaderButton';
import AlbumList from '@/Components/Admin/Content/Albums/AlbumList';

export default {
    name: 'AdminContentAlbumIndex',
    props: {
        albums: {
            type: Array,
            default() {
                return []
            }
        }
    },
    components: {
        PageHeader,
        PageHeaderButton,
        AlbumList
    },
}
</script>

<style lang="scss" scoped>

</style>
