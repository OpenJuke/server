<template>
    <section class="artist-list">
        <header>
            <div>ID</div>
            <div>Cover</div>
            <div>Name</div>
            <div>Alternative Name</div>
        </header>
        <main>
            <div class="item" v-for="artist in artists" :key="artist.id">
                <div>{{ artist.id }}</div>
                <div><img :src="artist.cover" class="table-image-round" v-if="artist.cover" /></div>
                <div>{{ artist.name }}</div>
                <div>{{ artist.alternative_name }}</div>
            </div>
        </main>
    </section>
</template>

<script>
import OButton from '@/Components/Common/OButton';

export default {
    name: 'AlbumArtistList',
    components: {
        OButton
    },
    props: {
        artists: {
            type: Array,
            default() {
                return [];
            }
        }
    },
}
</script>

<style lang="scss" scoped>
.artist-list {
    & header, & main > div {
        display: grid;
        grid-template-columns: 50px 70px 1fr 1fr;
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
            }

            &:hover {
                background: rgba(255,255,255,0.07);
            }
        }
    }
}
</style>
