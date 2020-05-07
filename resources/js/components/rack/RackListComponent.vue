<template>
    <div class="container-sm p-0">
        <BlockUI v-if="isBlock" :message="msg"></BlockUI>

        <div class="jumbotron bg-white text-danger">
            <div class="col text-right">
                <div class="btn-group">
                    <button
                        type="button"
                        class="btn btn-primary dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        เรียงลำดับ
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" :class="{'active' : (orderBy == 'name' || orderBy == '') }" @click="getRackData('name')">เรียงจากชื่อ</a>
                        <a class="dropdown-item" :class="{'active' : orderBy == 'seq' }" @click="getRackData('seq')"
                            >เรียงจากลำดับการหยิบ</a
                        >
                    </div>
                </div>
            </div>
            <div class="col text-center">
                <a href="/racks/create" class="btn btn-danger"
                    >เพิ่มชั้นวางสินค้า</a
                >
            </div>
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3 auto">
                    <div
                        class="card text-white bg-danger mb-3 text-center"
                        v-for="data in laravelData.data"
                        :key="data.rack_id"
                    >
                        <div class="card-header">
                            <h4 class="pt-2">
                                RACK : {{ data.rack_no }} ({{ data.rack_id }})
                            </h4>

                            <div class="form-group row">
                                <label class="col-5 col-form-label text-right"
                                    >ลำดับการหยิบ :
                                </label>
                                <div class="col-3">
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="rackPickSeq[]"
                                        :id="'rack-' + data.rack_id"
                                        :value="data.pick_seq"
                                    />
                                </div>
                                <button
                                    class="btn btn-sm btn-success"
                                    @click="changeRackPickSeq(data.rack_id)"
                                >
                                    บันทึก
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-danger bg-white">
                            <h5 class="card-title float-sm-left pt-2">
                                {{ data.rack_unit }} Unit
                            </h5>

                            <div class="btn-group float-sm-right">
                                <div class="btn-group">
                                    <button
                                        type="button"
                                        class="btn btn-danger dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        ตัวเลือก
                                    </button>
                                    <div
                                        class="dropdown-menu dropdown-menu-right"
                                    >
                                        <a
                                            :href="'/racks/' + data.rack_id"
                                            class="dropdown-item"
                                            type="button"
                                        >
                                            แก้ไข
                                        </a>
                                        <button
                                            class="dropdown-item"
                                            type="button"
                                            @click="printAll(data.rack_id)"
                                        >
                                            พิมพ์
                                        </button>

                                        <button
                                            class="dropdown-item"
                                            type="button"
                                            @click="deleteRack(data.rack_id)"
                                        >
                                            ลบ
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <table
                                class="table table-bordered mt-5"
                                width="100%"
                            >
                                <thead>
                                    <tr v-for="shelf in data.shelf">
                                        <th width="50%">
                                            {{ shelf.store_name }}
                                            <br />
                                            <span
                                                v-if="shelf.store_id != null"
                                                class="badge badge-primary"
                                                >{{ shelf.type_name }}</span
                                            >
                                        </th>
                                        <th width="25%">
                                            {{ shelf.shelf_no }}
                                        </th>
                                        <th width="25%">
                                            {{ shelf.shelf_type }} Unit
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <pagination
            :data="laravelData"
            @pagination-change-page="getResults"
        ></pagination>
    </div>
</template>

<script>
import EventBus from "../EventBus";
import FlashMessage from "../FlashMessage";

export default {
    props: [],
    data: function() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),

            rackData: [],
            laravelData: {},
            searchData: {},
            hasSearch: false,
            rowStart: 1,
            colStart: 1,
            isBlock: false,
            msg: "Please wait...",
            events: [],
            orderBy: name,
        };
    },
    methods: {
        eventText(e) {
            return `${e.type}: ${
                e.isCheckbox ? e.target.checked : e.target.value
            }`;
        },
        addEvent({ type, target }) {
            const event = {
                type,
                isCheckbox: target.type === "checkbox",
                target: {
                    value: target.value,
                    checked: target.checked
                }
            };
            this.events.push(event);
        },
        getResults(page = 1, optional = '') {
            this.isBlock = true;
            var vueInst = this;
            let url = "/racks?page=" + page;
            let queryString = "";
            // console.log(this.hasSearch);
            // console.log(this.searchData);
            if (this.hasSearch) {
                queryString = "&" + $.param(this.searchData);
            }

            if (optional !== '') {
                queryString += "&" + $.param(optional);
            }
            console.log(url + queryString);
            axios.get(url + queryString).then(response => {
                vueInst.isBlock = false;
                console.log(response.data.data.data);
                this.laravelData = response.data.data;
            });
        },

        printAll(rackId = "") {
            this.$swal({
                title: "ระบุ Row และ Column เริ่มต้น",
                preConfirm: () => {
                    var text = "";
                    if (document.getElementById("rowStart").value) {
                        // Handle return value
                    } else {
                        text = "row start";
                    }

                    if (document.getElementById("colStart").value) {
                        // Handle return value
                    } else {
                        if (text != "") {
                            text += " and ";
                        }
                        text += "column start ";
                    }
                    console.log(text);
                    if (text != "") {
                        console.log("opeworpew");
                        this.$swal.showValidationMessage(text + " is missing");
                    }
                },

                html: `<form id="form-print" action="/subshelfs/print/" method="get" target="_blank"> 
          <input type="hidden" name="_token" value="${this.csrf}">
          <input type="hidden" name="rackId" value="${rackId}">
          <label>Row : </label><input name="rowStart" value="${this.rowStart}" placeholder="Row Start" class="swal2-input" id="rowStart">
        <label>Column : </label>
        <input name="colStart" value="${this.colStart}" placeholder="Column Start" class="swal2-input" id="colStart"></form>`,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "submit"
            }).then(result => {
                if (result.value) {
                    console.log("ok");
                    $("#form-print").submit();
                } else if (result.dismiss == "cancel") {
                    console.log("cancel");
                }
            });
        },

        deleteRack(rackId = "") {
            this.$swal({
                title: "ยืนยันการลบชั้นวางนี้ ?",
                showCloseButton: true,
                showCancelButton: true
            }).then(result => {
                this.isBlock = true;
                window.location = "/racks/delete/" + rackId;
            });
        },

        updateData(data) {
            // console.log("update data");
            // console.log(data);
            this.searchData = data.searchData;

            if (data.hasSearch) {
                // console.log("sssss");
                this.hasSearch = data.hasSearch;
                this.getResults();
            }
        },

        getRackData(orderBy = "name") {
            this.orderBy = orderBy;
            let optional = { order_by: orderBy };
            this.getResults(1, optional);
        },
        changeRackPickSeq(rackId) {
            let el = $("#rack-" + rackId);

            let seq = el.val();
            let vueInst = this;
            console.log("seq id : " + rackId + " = " + seq);
            axios
                .post("/racks/" + rackId + "/edit-pick-seq", {
                    seq: seq,
                    _token: vueInst.csrf
                })
                .then(function(response) {
                    console.log(response);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.getResults();

        EventBus.$on("DATA_PUBLISHED", searchData => {
            this.updateData(searchData);
        });
    },
    updated: function() {}
    //     mounted () {
    //         EventBus.$on('DATA_PUBLISHED', (searchData) => {
    //             console.log('test');
    //             this.updateData(searchData);
    //         })
    //   }
};
</script>

<style scoped>
/* stuff here */
</style>
