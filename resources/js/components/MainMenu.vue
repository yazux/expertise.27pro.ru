<template>
    <nav class="header-nav">
        <ul class="header-nav__list">
            <li v-for="(item, i) in Object.values(menu)" v-bind:key="i" class="header-nav__list__item">
                <a v-if="item.link" v-bind:href="item.link" v-bind:class="{'header-nav__link': true, 'active': (item.name == $props.currentRoute)}">{{item.label}}</a>
                <span v-else v-bind:class="{'header-nav__link no-link': true, 'active': (item.name == $props.currentRoute)}">{{item.label}}</span>
            
                <ul v-if="item.child && item.child.length" class="header-nav__child-list">
                    <li v-for="(child, j) in item.child" v-bind:key="j" class="header-nav__child-list__item">
                        <a v-bind:href="child.link" class="header-nav__child-link">{{child.label}}</a>
                    </li>
                </ul>
            </li>

        
            <li v-if="$props.instagramLink" class="header-nav__list__item-social">
                <a v-bind:href="$props.instagramLink" class="header-nav__link-social" target="_blank">
                    <img src="/public/img/instagram.svg" alt="instagram" title="Instagram">
                </a>
            </li>
            <li v-if="$props.watsappLink" class="header-nav__list__item-social">
                <a v-bind:href="$props.watsappLink" class="header-nav__link-social" target="_blank">
                    <img src="/public/img/whatsapp.svg" alt="whatsapp" title="WhatsApp">
                </a>
            </li>
            <li v-if="$props.appdvLink" class="header-nav__list__item-social">
                <a v-bind:href="$props.appdvLink" class="header-nav__link-social appdv" target="_blank">
                    <img src="/public/img/logo.png" alt="Сайт группы компаний" title="Сайт группы компаний">
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
    import axios from 'axios';
    export default {
        name: 'main-menu',
        props: {
            currentRoute: {
                type: String,
                default: 'home'
            },
            instagramLink: {
                type: String,
                default: ''
            },
            watsappLink: {
                type: String,
                default: ''
            },
            appdvLink: {
                type: String,
                default: ''
            }
        },
        components: {},
        data: function () {
            return {
                menu: {
                    home: {
                        link: '/',
                        label: 'Главная',
                        name: 'home',
                        child: []
                    },
                    regions: {
                        link: null,
                        label: 'Регионы',
                        name: 'regions',
                        child: []
                    },
                    projects: {
                        link: '/projects',
                        label: 'Объекты',
                        name: 'projects',
                        child: []
                    },
                    static: {
                        link: '/static/info',
                        label: 'Информация',
                        name: 'info',
                        child: []
                    }
                },
                regions: []
            }
        },
        created() {
            this.$nextTick(() => this.getRegions());
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
        watch: {
            'regions'(regions) {
                if (regions && regions.length) {
                    this.menu.regions.child = [];
                    regions.map(item => {
                        this.menu.regions.child.push({
                            link: '/regions/' + item.id,
                            label: item.name,
                            name: 'region',
                            child: []
                        });
                        this.menu.projects.child.push({
                            link: '/regions/' + item.id + '/projects',
                            label: item.name,
                            name: 'regionProjects',
                            child: []
                        });
                    });
                }
            }
        },
        methods: {
            getRegions() {
                return axios.get( this.ajaxEndPont + '/regions' ).then(r => {
                    if (r && r.data) this.regions = Object.assign([], r.data);
                });
            }
        }
    }
</script>
<style lang="css">
    .header-nav{}
    .header-nav__list{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .header-nav__list__item{
        position: relative;
    }

    .header-nav__list__item-social{
        margin-left: 10px;
    }
    .header-nav__link-social{
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .header-nav__link-social.appdv{
        width: 50px;
        height: 30px;
    }
    .header-nav__link-social img{
        max-width: 100%;
        max-height: 100px;
    }

    .header-nav__link{
        color: var(--text-color-white);
        font-size: 17px;
        text-decoration: none;
        transition: 0.25s ease-in-out;
        padding: 5px 14px;
        font-weight: normal;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .header-nav__link.no-link,
    .header-nav__link.no-link:hover{
        cursor: default;
    }
    .header-nav__link:hover,
    .header-nav__link.active{
        background-color: var(--color-two);
    }


    .header-nav__child-list{
        list-style: none;
        padding: 0px;
        margin: 0px;
        position: absolute;
        top: 70px;
        left: 0px;
        background-color: var(--color-one);
        width: 350px;
        z-index: 10;
    }
    .header-nav__child-list__item{
        padding: 0px;
        margin: 0px;
    }
    .header-nav__child-link{
        color: var(--text-color-white);
        font-size: 14px;
        text-decoration: none;
        transition: 0.25s ease-in-out;
        padding: 0 14px;
        font-weight: normal;
        height: 0px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        transition: 0.25s ease-in-out;
        overflow: hidden;
    }
    .header-nav__child-link:hover{
        background-color: var(--color-two);
    }
    .header-nav__list__item:hover .header-nav__child-link{
        height: 30px;
    }
</style>