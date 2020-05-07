<template>
    <div class="container-sm">
        <flash-message></flash-message>

        <div class="jumbotron bg-white">
            <h1 class="display-6 text-danger">แก้ไขชั้นวางสินค้า</h1>
            <p class="lead">
                <!-- ดูรายละเอียดชั้นวางสินค้าในคลัง และสามารถแก้ไข พิมพ์บาร์โค้ด หรือลบชั้นวางได้ -->
            </p>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#rack"
                        >Rack</a
                    >
                </li>
                <li class="nav-item">
                    <a :class="{ 'nav-link' : changeTab == true, 'nav-link disabled' : changeTab == false}" data-toggle="tab" href="#shelf"
                        >Shelf</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#print-barcode"
                        >Print Barcode Subshelf</a
                    >
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div
                    class="jumbotron jumbotron-fluid bg-white text-danger mb-0"
                >
                    <div class="container">
                        <!-- <h1 class="display-4">Fluid jumbotron</h1> -->
                        <h1 class="display-5 text-center">
                            {{ laravelData.rack_no }}
                        </h1>
                    </div>
                </div>

                <div id="rack" class="container tab-pane active">
                    <form :action="action_edit_rack" method="get">
                        <div class="row" v-for="shelf in list">
                            <div class="col-md-6 offset-md-3 col-sm-12">
                                <div class="table-responsive">
                                    <table
                                        class="table border-shelf"
                                        id="table-rack"
                                    >
                                        <tr
                                            :class="'shelf-' + shelf.shelf_unit"
                                        >
                                            <td class="text-center" width="5%">
                                                {{ shelf.shelf_unit }}Unit
                                            </td>
                                            <td class="text-center" width="10%">
                                                <h6>
                                                    <span
                                                        v-if="
                                                            shelf.amount_of_pd >
                                                                0
                                                        "
                                                        >มีสินค้า</span
                                                    ><span v-else
                                                        >ไม่มีสินค้า</span
                                                    >
                                                </h6>
                                            </td>
                                            <td class="text-center" width="25%">
                                                {{ shelf.store_name }}
                                            </td>

                                            <td class="text-center" width="25%">
                                                {{ shelf.date_start }}
                                            </td>

                                            <td class="text-center" width="25%">
                                                <span v-if="shelf.is_unlimit"
                                                    >Unlimit</span
                                                ><span v-else>{{
                                                    shelf.date_expire
                                                }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <table class="table table-borderless mt-3">
                            <tr>
                                <td width="40%" class="text-center"><h5>ชื่อ shelf</h5></td>
                                <td width="20%" class="text-center"><h5>ลำดับการหยิบ</h5></td>
                                <td width="20%" class="text-center"><h5>ประเภทชั้นวาง</h5></td>
                                <td width="20%" class="text-center"><h5>จำนวน Unit</h5></td>
                            </tr>
                        </table>
                        <!-- <div class="row">
                            <div class="col-5 text-center">
                                <h5>ชื่อ shelf</h5>
                            </div>

                            <div class="col-2 text-center">
                                <h5>ลำดับการหยิบ</h5>
                            </div>

                            <div class="col-3 text-center">
                                <h5>ประเภทชั้นวาง</h5>
                            </div>

                            <div class="col-2 text-center">
                                <h5>จำนวน Unit</h5>
                            </div>
                        </div> -->
                        <div class="row mt-2">
                            <div class="col">
                                <draggable
                                    :list="list"
                                    :disabled="!enabled"
                                    class="list-group"
                                    ghost-class="ghost"
                                    :move="checkMove"
                                    @start="dragging = true"
                                    @end="dragging = false"
                                >
                                    <div
                                        class="list-group-item"
                                        v-for="(shelf, index) in list"
                                        :key="index"
                                    >
                                        <div class="row">
                                            <div class="col-2">
                                                <font-awesome-icon
                                                    icon="arrows-alt"
                                                />
                                            </div>
                                            <div class="col-3">
                                                <input
                                                    type="hidden"
                                                    class="form-control"
                                                    name="shelfId[]"
                                                    :value="shelf.shelf_id"
                                                />

                                                <input
                                                    class="form-control"
                                                    name="shelfNo[]"
                                                    :value="shelf.shelf_no"
                                                />
                                                <span
                                                    v-if="shelf.shelf_id == ''"
                                                    class="badge badge-info text-white"
                                                    >new shelf</span
                                                >
                                            </div>

                                            <div class="col-2">
                                                <input
                                                    class="form-control"
                                                    type="number"
                                                    name="shelfPickSeq[]"
                                                    :value="shelf.shelf_seq"
                                                />
                                            </div>

                                            <div class="col-3">
                                                <select-shelf-type
                                                    :data="shelf_type"
                                                    :select="shelf.type_id"
                                                ></select-shelf-type>
                                            </div>

                                            <div class="col-2">
                                                <select-shelf-unit
                                                    :data="max_shelf_unit"
                                                    :select="shelf.shelf_unit"
                                                    :key="index"
                                                    v-model="shelf.shelf_unit"
                                                    @input="
                                                        changeShelfUnit(
                                                            $event,
                                                            index
                                                        )
                                                    "
                                                    @focusUnit="
                                                        setOldValueUnit(
                                                            $event,
                                                            index
                                                        )
                                                    "
                                                ></select-shelf-unit>
                                            </div>
                                        </div>
                                    </div>
                                </draggable>

                                <!-- {{ list }} -->
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col text-center">
                                <button
                                    class="btn btn-danger text-center"
                                    type="submit"
                                >
                                    แก้ไขชั้นวางสินค้า
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- rack -->

                <div id="shelf" class="container tab-pane fade">
                    <form :action="action_edit_shelf" method="get">
                        <!-- Display Shelf -->
                        <div class="row" v-for="shelf in laravelData.shelf">
                            <div class="col-md-6 offset-md-3 col-sm-12">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered border-shelf"
                                    >
                                        <tr class="border border-danger">
                                            <td
                                                class="subshelf"
                                                v-for="(n,
                                                index) in shelf.count_subshelf"
                                                v-model="shelf.count_subshelf"
                                            ></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <table class="table bordered">
                                    <thead>
                                        <tr>
                                            <th width="15%" class="text-center">
                                                shelf no
                                            </th>
                                            <th width="40%" class="text-center">
                                                ชื่อร้าน
                                            </th>
                                            <th width="15%" class="text-center">
                                                ประเภทชั้นวาง
                                            </th>
                                            <th width="15%" class="text-center">
                                                จำนวน Subshelf
                                            </th>
                                            <th width="15%" class="text-center">
                                                จำนวน Sub-Shelf
                                                น้อยสุดที่สามารถแก้ไขได้
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(shelf,
                                            i) in laravelData.shelf"
                                        >
                                            <td class="text-center">
                                                {{ shelf.shelf_no }}
                                            </td>
                                            <td class="text-center">
                                                <span v-if="shelf.store_name">{{
                                                    shelf.store_name
                                                }}</span
                                                ><span v-else>-</span>
                                            </td>
                                            <td class="text-center">
                                                <span v-if="shelf.type_name">{{
                                                    shelf.type_name
                                                }}</span
                                                ><span v-else
                                                    >ชั้นวางสินค้า</span
                                                >
                                            </td>
                                            <td class="text-center">
                                                <input
                                                    type="hidden"
                                                    name="rackId"
                                                    :value="laravelData.rack_id"
                                                    class="form-control"
                                                />

                                                <input
                                                    type="hidden"
                                                    name="shelfId[]"
                                                    :value="shelf.shelf_id"
                                                    class="form-control"
                                                />

                                                <input
                                                    type="number"
                                                    name="maxSubshelf[]"
                                                    v-model.number="
                                                        shelf.count_subshelf
                                                    "
                                                    class="form-control"
                                                />
                                            </td>
                                            <td class="text-center">
                                                {{
                                                    shelf.max_subshelf_has_product
                                                }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center">
                                <button
                                    class="btn btn-danger text-center"
                                    type="submit"
                                >
                                    แก้ไขชั้นวางสินค้า
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- shelf -->

                <div id="print-barcode" class="container tab-pane fade">
                    <form :action="action_print_subshelf" method="get">
                        <input type="hidden" name="_token" :value="csrf" />
                        <div class="row">
                            <div class="col-3 offset-md-3">
                                <label for="colStart">Column Start</label>
                                <input
                                    class="form-control"
                                    name="colStart"
                                    :value="colStart"
                                    placeholder="column start"
                                />
                            </div>
                            <div class="col-3">
                                <label for="rowStart">Row Start</label>
                                <input
                                    class="form-control"
                                    name="rowStart"
                                    :value="rowStart"
                                    placeholder="row start"
                                />
                            </div>
                        </div>

                        <div
                            class="row mt-5"
                            v-for="(shelf, indexShelf) in laravelData.shelf"
                        >
                            <div class="col-2 border text-center p-3">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        v-model="shelfSelected[indexShelf]"
                                        :id="'shelf-' + indexShelf"
                                        :key="indexShelf"
                                    />

                                    <label
                                        class="custom-control-label"
                                        :for="'shelf-' + indexShelf"
                                        >{{ shelf.shelf_no }}</label
                                    >
                                </div>
                            </div>
                            <div
                                class="col border text-center p-3"
                                v-for="(subshelf,
                                indexSS) in laravelData.subshelf"
                                v-if="shelf.shelf_id == subshelf.shelf_id"
                            >
                                <span>
                                    <div class="custom-control custom-checkbox">
                                        <input
                                            type="checkbox"
                                            :class="
                                                'custom-control-input select-shelf-' +
                                                    indexShelf
                                            "
                                            name="selectSubshelf[]"
                                            :value="subshelf.subshelf_id"
                                            :checked="shelfSelected[indexShelf]"
                                            :key="indexSS"
                                            :id="
                                                'subshelf-' +
                                                    indexShelf +
                                                    '-' +
                                                    indexSS
                                            "
                                            @change="changeShelf(indexShelf)"
                                        />
                                        <label
                                            class="custom-control-label"
                                            :for="
                                                'subshelf-' +
                                                    indexShelf +
                                                    '-' +
                                                    indexSS
                                            "
                                            >{{ laravelData.rack_no }}-{{
                                                shelf.shelf_no
                                            }}-{{ subshelf.subshelf_no }}</label
                                        >
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col text-center mt-3">
                            <button class="btn btn-danger" type="submit">
                                print
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import SelectShelfType from "./SelectShelfTypeComponent";
import SelectShelfUnit from "./SelectShelfUnitComponent";

import FlashMessage from "../FlashMessage";

export default {
    props: [
        "id",
        "shelf_type",
        "max_shelf_unit",
        "action_edit_rack",
        "action_edit_shelf",
        "action_print_subshelf", 
        "errors", 
        "error", 
        "success"
    ],
    components: {
        draggable,
        SelectShelfType
    },
    data: function() {
        return {
            changeTab: true,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            laravelData: {},
            enabled: true,
            list: [],
            dragging: false,
            maxSubshelf: [],
            oldValueUnit: [],
            charactorEng: [
                "A",
                "B",
                "C",
                "D",
                "E",
                "F",
                "G",
                "H",
                "I",
                "J",
                "K",
                "L",
                "M",
                "N",
                "O",
                "P",
                "Q",
                "R",
                "S",
                "T",
                "U",
                "V",
                "W",
                "X",
                "Y",
                "Z"
            ],
            listShelfNo: [],
            shelfName: [],

            subshelfSelected: [[]],
            activeBtn: [],
            shelfSelected: [],
            colStart: 1,
            rowStart: 1,
            countChecked: []
        };
    },
    methods: {
        changeShelf(index) {
            this.changeTab = false;
            console.log("test -- index : " + index);
            // if(typeof this.subshelfSelected[index] == 'undefined') {
            //     return false;
            // }
            let countChecked = $(".select-shelf-" + index + ":checked").length;
            console.log(
                "index : " +
                    index +
                    " count subshelf : " +
                    this.laravelData.shelf[index].count_subshelf +
                    " amount subshelf : " +
                    countChecked
            );

            if (this.laravelData.shelf[index].count_subshelf == countChecked) {
                $("#shelf-" + index).prop("checked", true);
                console.log("check all ==> true");
                this.countChecked[index] = true;
            } else {
                $("#shelf-" + index).prop("checked", false);
                console.log("check all ==> false");
                this.countChecked[index] = false;
            }
        },

        getShelfNo(text = null) {
            if (text == null) {
                console.log("///// get shelf no /////");
                let count = Math.ceil(
                    this.list.length / this.charactorEng.length
                );

                let amt = this.shelfName.length % this.list.length;
                console.log(
                    "### count : " +
                        count +
                        " charactor length : " +
                        this.charactorEng.length
                );
                for (let c = 0; c < count; c++) {
                    for (let i = 0; i < this.charactorEng.length; i++) {
                        if (c == 0) {
                            console.log(
                                "c : " +
                                    c +
                                    " charactor : " +
                                    this.charactorEng[i]
                            );
                            this.shelfName.push(this.charactorEng[i]);
                        } else if (c > 0) {
                            console.log("c : " + c + " i : " + i);
                            console.log(
                                "charactor c : " +
                                    this.charactorEng[c - 1] +
                                    " charactor i : " +
                                    this.charactorEng[i]
                            );
                            this.shelfName.push(
                                this.charactorEng[c - 1] + this.charactorEng[i]
                            );
                        }
                    }
                }
            }
            // console.log(this.shelfName);
            let difference = this.shelfName.filter(
                // console.log(x);
                x => !this.listShelfNo.includes(x)
            );
            // console.log(this.listShelfNo);
            // console.log(this.shelfName);
            // console.log("----- difference -----");
            // console.log(difference);
            return difference[0];
        },
        getData() {
            let url = "/racks/" + this.id;

            axios.get(url).then(response => {
                this.laravelData = response.data.data;
                this.list = this.laravelData.shelf;
            });
        },
        checkMove: function(e) {
            window.console.log("Future index: " + e.draggedContext.futureIndex);
        },

        sumArray(array = [], key = "", start = 0, end = "", indexNotUse = []) {
            // console.log(array);
            var total = 0;
            if (end == "") {
                var end = array.length;
            }
            $.each(array, function(index, value) {
                // console.log('=> index : ' + index);
                // console.log($.inArray(index, indexNotUse));
                // console.log(
                //     "index : " + index + " start : " + start + " end : " + end
                // );
                if (index >= start && index <= end) {
                    if (
                        (indexNotUse.length > 0 &&
                            $.inArray(index, indexNotUse) == -1) ||
                        indexNotUse.length == 0
                    ) {
                        // console.log("> index : " + index);
                        if (typeof value[key] != "undefinded") {
                            total += parseInt(value[key]);
                        }
                    }
                }
            });

            return total;
        },

        changeShelfUnit(newUnit, index) {
            this.changeTab = false;
            console.log("--- change shelf unit ---");
            console.log("index : " + index + " new unit : " + newUnit);
            let oldUnit = this.oldValueUnit[index];
            var unitTotal = this.laravelData.rack_unit;
            var lastIndex = this.list.length;

            var totalNotThis =
                parseInt(this.sumArray(this.list, "shelf_unit", index + 1)) +
                parseInt(oldUnit);

            var canDo = false;
            // console.log(
            //     "old : " +
            //         oldUnit +
            //         " new : " +
            //         newUnit +
            //         " total : " +
            //         totalNotThis
            // );

            let hasProduct = this.checkHasProduct(index);
            console.log("*** has product : " + hasProduct);
            if (hasProduct == true) {
                alert("ไม่สามารถทำรายการได้ เนื่องจากมีสินค้าอยู่บนชั้นวาง");
                this.list[index].shelf_unit = oldUnit;
                $('[name^="selectShelfUnit"]')
                    .eq(index)
                    .val(oldUnit)
                    .trigger("change");
                return false;
            }

            if (newUnit <= totalNotThis) {
                canDo = true;
            } else {
                alert("ไม่สามารถทำรายการได้ เนื่องจากจำนวน unit เกิน");
                this.list[index].shelf_unit = oldUnit;
                $('[name^="selectShelfUnit"]')
                    .eq(index)
                    .val(oldUnit)
                    .trigger("change");

                canDo = false;
            }

            if (newUnit > oldUnit) {
                let canMix = this.checkCanMix(newUnit, oldUnit, index);
                console.log("**** can mix : " + canMix);

                if (canMix == false) {
                    this.list[index].shelf_unit = oldUnit;
                    alert("ไม่สามารถทำรายการได้ เนื่องจากผู้เช่าไม่เหมือนกัน");
                    this.list[index].shelf_unit = oldUnit;
                    $('[name^="selectShelfUnit"]')
                        .eq(index)
                        .val(oldUnit)
                        .trigger("change");

                    return false;
                }
            }

            // console.log(
            //     "total not this : " +
            //         totalNotThis +
            //         " new unit : " +
            //         newUnit +
            //         " can do : " +
            //         canDo
            // );
            // console.log($('[name^="shelfNo"]').val());
            // console.log(
            //     "*** old unit : " +
            //         oldUnit +
            //         " new unit : " +
            //         newUnit +
            //         " = " +
            //         (oldUnit - newUnit)
            // );
            if (canDo) {
                if (newUnit < oldUnit) {
                    this.listShelfNo = $("input[name^='shelfNo']")
                        .map(function(idx, ele) {
                            return $(ele).val();
                        })
                        .get();
                    console.log(this.listShelfNo);
                    // this.getShelfNo();
                    // แยก
                    console.log("--- separate ---");

                    let shelfData = Object.assign({}, this.list[index]);
                    shelfData.shelf_id = "";
                    shelfData.shelf_unit = oldUnit - newUnit;
                    shelfData.shelf_no = this.getShelfNo();

                    this.list[index].shelf_unit = newUnit;
                    if (index == lastIndex - 1) {
                        // console.log("case 1");
                        this.list.push(shelfData);
                    } else {
                        // console.log("case 2");
                        this.list.splice(index + 1, 0, shelfData);
                    }
                    // console.log(
                    //     "--> index : " + index + " last index : " + lastIndex
                    // );
                    // console.log(shelfData);
                    // console.log(this.list);

                    // console.log(this.list);
                } else if (newUnit > oldUnit) {
                    // รวม
                    console.log("--- include ---");
                    var balance = newUnit - oldUnit;
                    var setStart = null;
                    var count = 0;

                    for (let i = index + 1; i < lastIndex; i++) {
                        // console.log(this.list[i]);
                        balance = balance - this.list[i].shelf_unit;
                        // console.log(">> i " + i + " balance : " + balance);
                        if (i == lastIndex - 1) {
                            if (Math.abs(balance) > 0) {
                                this.list[i].shelf_unit = Math.abs(balance);
                            } else {
                                if (setStart == null) {
                                    setStart = i;
                                }
                                count++;
                            }
                        } else {
                            if (balance >= 0) {
                                if (setStart == null) {
                                    setStart = i;
                                }
                                count++;
                            } else if (balance < 0) {
                                // console.log(
                                //     "--- new value : " + Math.abs(balance)
                                // );
                                this.list[i].shelf_unit = Math.abs(balance);
                                break;
                            }
                        }
                    }

                    // console.log(
                    //     "set start : " + setStart + " count : " + count
                    // );
                    if (setStart != null && count > 0) {
                        this.list.splice(setStart, count);
                    }
                    // console.log(
                    //     "balance : " + balance + " old unit : " + oldUnit
                    // );
                }
            }

            this.getShelfNo();
        },
        checkCanMix(newUnit, oldUnit, index) {
            var lastIndex = this.list.length;
            var balance = newUnit - oldUnit;
            var setStart = null;
            var count = 0;
            var storeId = this.list[index].store_id;

            console.log("parent : store_id :: " + storeId);
            for (let i = index + 1; i < lastIndex; i++) {
                balance = balance - this.list[i].shelf_unit;
                console.log("i : " + i);

                let compareStore = this.compareStore(index, i);
                let compareRenting = this.compareRenting(index, i);

                if (compareStore == false || compareRenting == false) {
                    return false;
                }

                if (balance <= 0) {
                    break;
                }
            }
            return true;
        },
        checkHasProduct(index = -1) {
            if (index != -1) {
                var storeId = this.list[index].store_id;
                var rentingId = this.list[index].renting_id;
                var storeId = this.list[index].store_id;
                var dateStart = this.list[index].date_start;
                var dateExpire = this.list[index].date_expire;
                var shelfType = this.list[index].shelf_type;

                return this.list[index].amount_of_pd > 0;
            }
            return null;
        },
        compareRenting(indexParent, indexChild) {
            return (
                this.list[indexParent].date_start ==
                    this.list[indexChild].date_start &&
                this.list[indexParent].date_expire ==
                    this.list[indexChild].date_expire &&
                this.list[indexParent].shelf_type ==
                    this.list[indexChild].shelf_type
            );
        },
        compareStore(indexParent, indexChild) {
            return (
                this.list[indexParent].store_id ==
                this.list[indexChild].store_id
            );
        },
        submitShelf() {
            var bodyFormData = $("#form-shelf").serialize();
            console.log(bodyFormData);
            axios({
                method: "post",
                url: "/shelf",
                data: bodyFormData
                // headers: { "Content-Type": "multipart/form-data" }
            })
                .then(function(response) {
                    //handle success
                    console.log(response);
                })
                .catch(function(response) {
                    //handle error
                    console.log(response);
                });
        },
        setOldValueUnit(oldVal = null, index = null) {
            this.oldValueUnit[index] = oldVal;
            // console.log("-- set old value --");
            // console.log("old value : " + oldVal);
            // console.log("index : " + index);
        },
        changeUnitData(event) {
            console.log("change unit data");
            console.log(event);
        },
        checkFlashMessage() {
            let errorMessage = JSON.parse(this.errors);
            if(errorMessage.length > 0) {
                let message = {type : 'danger', msg : errorMessage};
                Bus.$emit('setFlashMessage', message);
                // console.log(errorMessage);
            } else if(this.error !== "") {
                let message = {type : 'danger', msg: [this.error]};
                Bus.$emit('setFlashMessage', message);
            } else if(this.success !== "") {
                let message = {type : 'success', msg: this.success};
                Bus.$emit('setFlashMessage', message);
            }
        },
    },
    mounted() {
        this.getData();
        this.checkFlashMessage();
    },
    updated() {
        console.log("----------------------- updated -----------------------");
        $("body").trigger("click");
    },
    computed: {
        draggingInfo() {
            return this.dragging ? "under drag" : "";
        }
    }
};
</script>

<style scoped>
/* stuff here */
.bd-example-border-utils [class^="border"] {
    display: inline-block;
    width: 3rem;
    height: 3rem;
    margin: 0.25rem;
    background-color: #f5f5f5;
}

.bd-example {
    padding: 1.5rem;
    margin-right: 0;
    margin-left: 0;
    border-width: 0.2rem;
}

.subshelf {
    padding: 1.8rem;
}

.borderless td,
.borderless th {
    border: none;
}

.list-group-item {
    cursor: all-scroll;
}

.border-shelf {
    border: 3px solid #bfbfbf;
}

.shelf-1 {
    height: 50px;
}

.shelf-2 {
    height: 100px;
}

.shelf-3 {
    height: 150px;
}

.shelf-4 {
    height: 200px;
}

.btn-group.subshelf,
.btn-group.shelf {
    display: flex;
}

.subshelf .btn,
.shelf .btn {
    flex: 1;
}
</style>
