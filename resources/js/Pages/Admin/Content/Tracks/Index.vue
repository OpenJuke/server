<template>
    <div>
        <PageHeader title="Tracks">
            <PageHeaderButton icon="plus" @click.native="$inertia.get($route('admin.content.tracks.create'))" />
        </PageHeader>

        <TrackList :tracks="tracks" />
    </div>
</template>

<script>
import PageHeader from '@/Components/Common/PageHeader';
import PageHeaderButton from '@/Components/Common/PageHeaderButton';
import TrackList from '@/Components/Admin/Content/Tracks/TrackList';

export default {
    name: 'AdminContentTrackIndex',
    props: {
        tracks: {
            type: Array,
            default() {
                return []
            }
        }
    },
    components: {
        PageHeader,
        PageHeaderButton,
        TrackList
    },
}
</script>

<style lang="scss" scoped>

</style>
