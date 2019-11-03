<template>
    <div class="content component vendors-component">
        <h1 v-if="$props.showTitle" class="vendors-component__title page-title">Заказы в работе</h1>
        
        <section v-if="componentVendors && componentVendors.length" class="vendors-component__list">
            <vendor v-for="vendor in componentVendors" v-bind:key="vendor.id" v-bind:vendor="vendor"></vendor>    
        </section>

        <a v-if="$props.showAllBtn" v-bind:href="(endPoint + '/vendors')" class="btn">Смотреть все проекты</a>

        <paginate
            v-if="!$props.showAllBtn && (componentVendors && componentVendors.length) && total > count"
            :page-count="lastPage"
            :initial-page="1"
            :click-handler="paginatorAction"
            :prev-text="'Назад'"
            :next-text="'Вперёд'"
            :container-class="'pagination'"
            :page-class="'page-item'"
        ></paginate>

    </div>
</template>
<script>
    import axios from 'axios';
    import paginate from 'vuejs-paginate';
    import Vendor from './Vendor';
    export default {
        name: 'vendors',
        props: {
            showAllBtn: {
                type: Boolean,
                default: false
            },
            showTitle: {
                type: Boolean,
                default: false
            },
            noAjax: {
                type: Boolean,
                default: false
            },
            vendors: {
                type: Array,
                default: []
            }
        },
        components: {paginate, Vendor},
        data: function () {
            return {
                count: 9,
                current_page: 1,
                page: 1,
                total: 0,
                lastPage: 0,
                componentVendors: []
            }
        },
        created() {
            this.$nextTick(() => {
                if (this.$props.noAjax) this.componentVendors = Object.assign([], this.$props.vendors);
                else this.getVendors(this.count);
            });
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
            paginatorAction(page) {
                this.page = page;
                this.getVendors(this.count, this.page);  
            },
            getVendors(count, page, sortBy, sort_type) {
                let url = this.ajaxEndPont + '/vendors?' +
                    'count='      + ((count)     ? count     : 9    ) +
                    '&page='      + ((page)      ? page      : 1    ) +
                    '&sort_by='   + ((sortBy)    ? sortBy    : 'id' ) +
                    '&sort_type=' + ((sort_type) ? sort_type : 'asc');

                return axios.get(url).then(r => {
                    if (r && r.data && r.data.data) {
                        this.componentVendors = Object.assign([], r.data.data);
                        this.total = r.data.total;
                        this.lastPage = r.data.last_page;
                    }
                });
            }
        }
    }
</script>
<style lang="css">
    .vendors-component{}
    .vendors-component__list{
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .vendors-component .btn{
        margin: 0 0 0 auto;
    }
    .vendors-component__link{}
   
</style>