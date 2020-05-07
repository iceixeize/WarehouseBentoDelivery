<template>
    <div class="container-sm">
        <div class="jumbotron bg-white">
            <h1 class="display-6 text-danger">สร้างชั้นวางสินค้า</h1>
            <p class="lead">
                <!-- ดูรายละเอียดชั้นวางสินค้าในคลัง และสามารถแก้ไข พิมพ์บาร์โค้ด หรือลบชั้นวางได้ -->
            </p>
            <hr class="my-2" />
            <p>
                สร้างชั้นวางสินค้า โดยสามารถระบุชื่อ จำนวนชั้นวางที่ต้องการได้
            </p>
        </div>

        <BlockUI v-if="isBlock" :message="msg"></BlockUI>
        
        <flash-message></flash-message>

             
        <!-- <div v-if="JSON.parse(errors).length > 0">
            <b-alert show variant="danger">
                <span v-for="(error, index) in JSON.parse(errors)"
                    >{{ error }}<br
                /></span>
            </b-alert>
        </div> -->
        
        <!-- <div class="row pt-5 pb-5 bg-white"> -->
        <form :action="action" method="post" id="create-rack">
            <input type="hidden" name="_token" :value="csrf" />
            <div class="form-group row">
                <div class="col-7">
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th colspan="3">Rack : {{ new_rack_no }}</th>
                                </tr>
                                <tr>
                                    <th>Shelf Name</th>
                                    <th>จำนวน Unit</th>
                                    <th>ประเภทชั้นวาง</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-if="selectShelfUnit.length > 0"
                                    v-for="(amt, index) in selectShelfUnit"
                                    :key="index"
                                >
                                    <td>
                                        <input
                                            v-if="shelfAmount"
                                            class="form-control"
                                            name="inputShelfName[]"
                                            :key="index"
                                            :value="shelfName[index]"
                                        />
                                    </td>
                                    <td>
                                        <select
                                            class="form-control"
                                            name="selectShelfUnit[]"
                                            @change="changeUnit($event, index)"
                                            v-model="selectShelfUnit[index]"
                                        >
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select
                                            class="form-control"
                                            name="selectShelfType[]" 
                                        >
                                            <option value=""
                                                >เลือกประเภทชั้นวาง</option
                                            >
                                            <option value="0"
                                                >ชั้นวางสินค้า</option
                                            >
                                            <option
                                                v-for="(obj, i) in JSON.parse(
                                                    shelf_type
                                                )"
                                                :value="obj.shelf_type_id"
                                                :key="i"
                                            >
                                                {{ obj.shelf_type }}
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <th colspan="3">
                                        ระบุจำนวนชั้นวาง
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control"
                            name="rackNo"
                            aria-describedby="rackNoHelp"
                            placeholder="หมายเลขชั้นวาง"
                            v-model="new_rack_no"
                        />
                        <small id="rackNoHelp" class="form-text text-muted"
                            >สามารถใส่ตัวอักษรภาษาอังกฤษ กับหมายเลขได้</small
                        >
                    </div>

                    <div class="form-group">
                        <input
                            type="number"
                            class="form-control"
                            name="shelfAmount"
                            aria-describedby="shelfAmountHelp"
                            placeholder="จำนวนชั้นวาง"
                            v-model="shelfAmount"
                            @change="changeAmount($event)"
                            :max="max_shelf"
                        />
                        <small id="shelfAmountHelp" class="form-text text-muted"
                            >สามารถใส่ได้สูงสุด {{ max_shelf }} ชั้นวาง</small
                        >
                    </div>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </form>
        <!-- </div> -->
    </div>
</template>


<script>
import FlashMessage from "../FlashMessage";


export default {
    props: ["rack_no", "shelf_type", "action", "max_shelf", "errors", "error", "success"],
    
    data: function() {
        return {
            msg: 'Loading...',
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            shelfName: [
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
            shelfAmount: "",
            arrayAmount: [],

            selectShelfUnit: [],
            selectShelfType: [],
            inputShelfName: [],
            isBlock: false,
            new_rack_no: this.rack_no,

            // form: this.$form({
            //     'rackNo': null,
            //     'shelfAmount': null,
            // })
        };
    },
    methods: {
        validateInput(input){
            if(Object.keys(this.fields).length > 0) {
                return this.fields[input].valid;
            }
        },
        sendform() {
            console.log("send form");
            console.log(this.action);
            return false;
        },
        changeAmount: function(event) {
            let amount = event.target.value;

            // console.log('max shelf 1: ' + max_shelf);
            console.log(
                "amount => " + amount + " max shelf 2: " + this.max_shelf
            );
            // console.log('max shelf 3: ' + maxShelf);
            // console.log('max shelf 4: ' + this.maxShelf);

            if (amount > parseInt(this.max_shelf)) {
                this.$swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถทำรายการได้ เนื่องจากชั้นวางเกิน",
                });
                // this.showAlert("ไม่สามารถทำรายการได้ เนื่องจากชั้นวางเกิน");
                // alert("ไม่สามารถทำรายการได้ เนื่องจากชั้นวางเกิน");
                this.arrayAmount = [];
                this.shelfAmount = "";
                return false;
            }

            if (this.shelfAmount > 26) {
                let count = Math.ceil(
                    this.shelfAmount / this.charactorEng.length
                );

                let amt = this.shelfName.length % this.shelfAmount;

                this.shelfName = [];
                console.log("count : " + count + " amt : " + amt);

                for (let c = 0; c < count; c++) {
                    for (let i = 0; i < this.charactorEng.length; i++) {
                        if (c == 0) {
                            console.log(this.charactorEng[i]);
                            this.shelfName.push(this.charactorEng[i]);
                        } else if (c > 0) {
                            console.log("c = " + c);
                            console.log(
                                this.charactorEng[c - 1] + this.charactorEng[i]
                            );
                            this.shelfName.push(
                                this.charactorEng[c - 1] + this.charactorEng[i]
                            );
                        }
                    }
                }
            }

            this.arrayAmount = [];
            this.selectShelfUnit = [];
            for (let i = 0; i < amount; i++) {
                this.arrayAmount.push(1);
                this.selectShelfUnit.push(1);
            }
        },
        changeUnit: function(event, index) {
            let value = event.target.value;
            const reducer = (accumulator, currentValue) =>
                parseInt(accumulator) + parseInt(currentValue);
            let unitBalance = this.selectShelfUnit.slice(index + 1);
            let sumBefore = this.selectShelfUnit
                .slice(0, index + 1)
                .reduce(reducer);

            if (unitBalance.length == 0) {
                let balance = this.shelfAmount - sumBefore;
                if (value < this.shelfAmount) {
                    for (let i = 1; i <= balance; i++) {
                        console.log("i : " + i);
                        this.selectShelfUnit.push(1);
                    }
                } else {
                    this.selectShelfUnit[index] = 1;
                    alert("ไม่สามารถทำรายการได้ เนื่องจากจำนวนชั้นวางเกิน");
                }
            } else {
                console.log("index : " + index);

                let sumAfter = unitBalance.reduce(reducer);

                let balance = this.shelfAmount - sumBefore;
                console.log("-- balance : " + balance);
                console.log(
                    "-- shelf amount: " +
                        this.shelfAmount +
                        " sum before : " +
                        sumBefore +
                        " sum after : " +
                        sumAfter
                );

                if (balance > 0) {
                    let amountSlice = 1;
                    if (index != 0) {
                        amountSlice = index;
                    }
                    this.selectShelfUnit = this.selectShelfUnit.splice(
                        0,
                        index + 1
                    );
                    for (let i = 1; i <= balance; i++) {
                        console.log("i : " + i);
                        this.selectShelfUnit.push(1);
                    }
                } else if (balance == 0) {
                    this.selectShelfUnit[index] = value;
                    this.selectShelfUnit = this.selectShelfUnit.slice(
                        0,
                        index + 1
                    );
                }
            }
        },
        showAlert(text = "") {
            // Use sweetalert2
            this.$swal(text);
        },
        toggleBlock() {
            this.isBlock = !this.isBlock;
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
        submitCreateRack(event) {
            console.log('-- submit create rack ---');
        },
        
    },
    mounted() {
        this.checkFlashMessage();
    }
};
</script>

<style scoped>
/* stuff here */
</style>
