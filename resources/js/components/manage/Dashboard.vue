<template>
    <div class="container-sm">
        <data-table :columns="columns" url="/dashboard-datatable">
        </data-table>
    </div>
</template>

<script>
export default {
    props: [],
    components: {},
    data() {
        return {
            columns: [
                {
                    label: 'ID',
                    name: 'warehouse_order_id',
                    orderable: true,
                },
                {
                    label: 'ชื่อร้าน',
                    name: 'store_name',
                    orderable: true,
                },
                {
                    label: 'Bento Order No',
                    name: 'order_no',
                    orderable: true,
                },
                {
                    label: 'วันที่ได้รับออเดอร์',
                    name: 'date_create',
                    orderable: true,
                },
                {
                    label: 'ชื่อติดต่อร้าน',
                    name: 'contact_name',
                    orderable: true,
                },
                {
                    label: 'เบอร์โทร',
                    name: 'phone',
                    orderable: true,
                },

                {
                    label: 'ชื่อผู้สั่งซื้อ',
                    name: 'shipping_firstname',
                    orderable: true,
                },

                {
                    label: 'นามสกุลผู้สั่งซื้อ',
                    name: 'shipping_lastname',
                    orderable: true,
                },

                {
                    label: 'เบอร์ติดต่อ',
                    name: 'shipping_phone',
                    orderable: true,
                },

                {
                    label: 'สถานะ',
                    name: 'shipping_phone',
                    orderable: true,
                },

                {
                    label: 'Action',
                    name: 'shipping_phone',
                    orderable: true,
                },
            ]
        };
    },

    mounted() {},

    methods: {}
};
</script>

<style scoped>
/* stuff here */
</style>
