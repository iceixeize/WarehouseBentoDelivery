<template>
    <div class="row">
                <div class="col-sm-11 pl-0">
                    <div class="collapse multi-collapse" id="search">
                        <div class="card card-body">
                            <form>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm search"
                                        name="rack_no"
                                        placeholder="ชื่อชั้นวาง"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm search"
                                        name="store_name"
                                        placeholder="ชื่อร้าน"
                                    />
                                </div>

                                <div class="form-group">
                                    <select
                                        class="form-control form-control-sm search"
                                        name="shelf_status_avaiable"
                                    >
                                        <option value=""
                                            >สถานะของชั้นวาง</option
                                        >
                                        <option value="1"
                                            >ระบุ Unit ของ Rack ที่ว่าง</option
                                        >
                                        <option value="2"
                                            >ระบุ Unit ของ Shelf ที่ว่าง</option
                                        >
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm search"
                                        name="amount_available"
                                        placeholder="จำนวน"
                                    />
                                </div>

                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm justify-content-center"
                                    @click="search"
                                >
                                    ค้นหา
                                </button>

                                <button
                                    type="reset"
                                    class="btn btn-outline-dark btn-sm justify-content-center"
                                    @click="reset"
                                >
                                    รีเซ็ต
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
export default {
    props: [],
    data: function() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    methods: {
        search() {
            this.$emit('searchData');
        },

        reset() {
            this.$emit('resetData');
        },
    },

};
</script>

<style scoped>
/* stuff here */
</style>
