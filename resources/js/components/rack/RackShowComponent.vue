<template>
    <div class="container-sm">
        <flash-message></flash-message>
        <div class="jumbotron bg-white">
            <h1 class="display-6 text-danger">ชั้นวางสินค้า</h1>
            <p class="lead">
                <!-- ดูรายละเอียดชั้นวางสินค้าในคลัง และสามารถแก้ไข พิมพ์บาร์โค้ด หรือลบชั้นวางได้ -->
            </p>
            <hr class="my-2" />
            <p>
                ดูรายละเอียดชั้นวางสินค้าในคลัง และสามารถแก้ไข พิมพ์บาร์โค้ด
                หรือลบชั้นวางได้
            </p>
            <p class="lead">
                <button
                    type="button"
                    class="btn btn-outline-danger float-sm-right"
                    data-toggle="collapse"
                    data-target="#search"
                    aria-expanded="false"
                    aria-controls="search"
                >
                    ค้นหา
                </button>
            </p>
            <rack-search-component
                @searchData="searchRack($event)"
                @resetData="resetRack()"
            ></rack-search-component>
        </div>

        <rack-list-component></rack-list-component>
    </div>
</template>

<script>
import RackList from "./RackListComponent";
import RackSearch from "./RackSearchComponent";

import FlashMessage from "../FlashMessage";
import EventBus from "../EventBus";

export default {
    props: ["errors", "error", "success"],
    components: {
        RackList,
        RackSearch
    },
    data: function() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            hasSearch: false,
            searchData: {},
        };
    },
    methods: {
        searchRack(event) {
            // console.log('searchRack');
            let hasSearch = false;
            let searchData = {};
            $(".search").each(function(index, el) {
                let name = $(el).attr("name");
                let value = $(el).val();
                if (value != "") {
                    searchData[name] = value;
                }
            });
            // console.log(searchData);
            // console.log(this.isEmptyObject({}));
            if (!this.isEmptyObject(searchData)) {
                hasSearch = true;
            }

            EventBus.$emit("DATA_PUBLISHED", {
                searchData: searchData,
                hasSearch: hasSearch
            });
            // console.log(this.searchData);
            // console.log('search rackkk');
            // console.log(event);
        },
        resetRack(event) {
            // console.log('searchRack');
            let hasSearch = false;
            let searchData = {};

            EventBus.$emit("DATA_PUBLISHED", {
                searchData: searchData,
                hasSearch: hasSearch
            });
        },
        isEmptyObject(obj) {
            for (var prop in obj) {
                if (obj.hasOwnProperty(prop)) return false;
            }

            return true;
        },
        checkFlashMessage() {
            let errorMessage = JSON.parse(this.errors);
            if(errorMessage.length > 0) {
                let message = {type : 'danger', msg : errorMessage};
                Bus.$emit('setFlashMessage', message);
                // console.log(errorMessage);
            } else if(this.error !== "") {
                console.log('error : ' + this.error);
                let message = {type : 'danger', msg: [this.error]};
                Bus.$emit('setFlashMessage', message);
            } else if(this.success !== "") {
                console.log('success : ' + this.success);

                let message = {type : 'success', msg: this.success};
                Bus.$emit('setFlashMessage', message);
            }
        },
    },
    mounted() {
        this.checkFlashMessage();
    },
    updated: function() {}
};
</script>

<style scoped>
/* stuff here */
</style>
