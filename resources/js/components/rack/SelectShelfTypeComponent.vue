<template>
    <div>
        <select class="form-control" name="selectShelfType[]">
            <option value="">เลือกประเภทชั้นวาง</option>
            <option value="0" :selected="select == 0">ชั้นวางสินค้า</option>
            <option
                v-for="(obj, i) in JSON.parse(data)"
                :value="obj.shelf_type_id"
                :key="i"
                :selected="select == obj.shelf_type_id"
            >
                {{ obj.shelf_type }}
            </option>
        </select>
    </div>
</template>
<script>
export default {
    props: ["data", "select"],
    data: function() {
        return {
            msg: "Loading...",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },
    methods: {},
    mounted() {}
};
</script>

<style scoped>
/* stuff here */
</style>
