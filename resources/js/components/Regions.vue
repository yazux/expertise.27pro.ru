<template>
    <div class="content component regions-component">
        <section v-if="regions && regions.length" class="regions-component__list">
            <region v-for="region in regions" v-bind:key="region.id" v-bind:region="region"></region>    
        </section>
    </div>
</template>
<script>
    import axios from 'axios';
    import paginate from 'vuejs-paginate';
    import Region from './region';
    export default {
        name: 'regions',
        props: {
            regions: {
                type: Array,
                default: []
            }
        },
        components: {Region},
        data: function () {
            return {}
        },
        created() {},
        computed: {
            endPoint() {
                return location.protocol + '//'
                    + location.hostname
                    + (location.port ? (':' + location.port) : '');
            },
            ajaxEndPont() {
                return this.endPoint + '/ajax';
            },
        },
        watch: {},
        methods: {}
    }
</script>
<style lang="css">
    .regions-component{}
    .regions-component__list{
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
</style>