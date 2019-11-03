<template>
    <article class="region-component__item" v-if="region && region.id">
        <a v-bind:href="(endPoint + '/regions/' + region.id)" class="region-component__link">
            <div class="region-component__hero-image">
                <img v-bind:src="('/storage/' + region.hero_image)" v-bind:alt="region.name" />
            </div>
            <div class="region-component__content">
                <p class="region-component__name">{{region.name}}</p>
                <p class="region-component__description" v-if="region.description">{{region.description}}</p>
                <p class="region-component__projects">{{(region.projects_count) ? ('Объектов: ' + region.projects_count) : 'Объектов: 0' }}</p>
            </div>
        </a>
    </article>
</template>
<script>
    export default {
        name: 'region',
        props: {
            region: {
                type: Object,
                default: () =>  {
                    return {};
                }
            }
        },
        components: {},
        data: function () {
            return {

            }
        },
        created() {

        },
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
        methods: {
        }
    }
</script>
<style lang="css">
    .region-component__item{
        width: calc(50% - 20px);
        height: 350px;
        overflow: hidden;
        margin: 0 10px 20px 10px;
        position: relative;
        border-radius: 4px;
        box-shadow: 0 0 14px rgba(0,0,0,.1);
        transition: 0.25s ease-in-out;
    }
    .region-component__item:hover{
        transform: translate(0, -10px);
        box-shadow: 0px 10px 25px 0px rgba(0,0,0,0.4);
    }
    .region-component__link{
        display: block;
        height: 100%;
        width: 100%;
        position: relative;
    }
    .region-component__hero-image{
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    .region-component__hero-image img{
        display: block;
        width: 100%;
        min-height: 100%;
        height: auto;
    }
    .region-component__content{
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: column;
        width: 100%;
        height: 50%;
        background-color: rgba(0, 0, 0, 0.3);
        transition: 0.25s ease-in-out;
        padding-top: 175px;
    }
    .region-component__item:hover .region-component__content{
        background-color: rgba(0, 0, 0, 0.5);
    }
    .region-component__name{
        color: #fff;
        text-transform: uppercase;
        font-size: 22px;
        line-height: 24px;
        margin: 0 0 15px 0;
        position: relative;
    }
    .region-component__name:after{
        content: '';
        height: 2px;
        width: 200px;
        background-color: #fff;
        display: block;
        position: absolute;
        bottom: -5px;
        left: calc(50% - 100px);
        transition: 0.25s ease-in-out;
        transform: translate(0px, 50px);
        opacity: 0;
    }
    .region-component__description,
    .region-component__projects{
        color: #fff;
        font-size: 16px;
        line-height: 18px;
        margin: 0 0 10px 0;
        transition: 0.25s ease-in-out;
        transform: translate(0px, 20px);
        opacity: 0;
        text-align: center;
        max-width: 90%;
    }
    .region-component__projects{
        margin: 0;
        font-size: 18px;
        line-height: 20px;
    }

    .region-component__item:hover .region-component__name:after,
    .region-component__item:hover .region-component__description,
    .region-component__item:hover .region-component__projects{
        transform: translate(0px, 0px);
        opacity: 1;
    }
</style>