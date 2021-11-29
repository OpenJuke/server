<template>
    <div>
        <PageHeader title="Artists">
            <PageHeaderButton icon="plus" @click.native="$inertia.get($route('admin.content.artists.create'))" />
        </PageHeader>

        <ArtistList :artists="artists" />
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import PageHeaderButton from '@/Components/Common/PageHeaderButton';
import ArtistList from '@/Components/Admin/Content/Artists/ArtistList';

export default {
    name: 'AdminContentArtistsIndex',
    props: {
        artists: {
            type: Array,
            default() {
                return []
            }
        }
    },
    components: {
        PageHeader,
        PageHeaderButton,
        ArtistList
    },
}
</script>

<style lang="scss" scoped>

</style>
