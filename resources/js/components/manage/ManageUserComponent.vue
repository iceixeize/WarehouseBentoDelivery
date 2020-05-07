<template>
    <div class="container-sm">
        <flash-message></flash-message>
        <b-jumbotron bg-variant="white" header-level="5">
            <template v-slot:header>จัดการผู้ใช้</template>
            <hr class="my-4" />
            <p>
                ระบบจะไม่แสดงรายชื่อของผู้ที่มี Permission : User manage
                เว้นแต่จะเข้าระบบแบบ Super Admin
                ในการแก้ไขสิทธ์การใช้งานคลัง
                และ User role ให้ใช้ปุ่ม Edit และ ใช้ปุ่ม Block เพื่อปิดการใช้งาน,
                UnBlock เพื่อเปิดใช้งานอีกครั้ง และ ปุ่ม Delete
                สำหรับปิดการใช้งานแบบถาวร
            </p>
        </b-jumbotron>
        
        <b-row align-h="center">
            <b-button :href="link_register" variant="success">เพิ่มผู้ใช้</b-button>
        </b-row>
        <data-table :columns="columns" url="/users-datatable" class="mt-5"> </data-table>
    </div>
</template>

<script>
import ActionUser from "./ActionUser";
import FlashMessage from "../FlashMessage";

export default {
    props: ["link_register", "error", "success", "errors"],
    components: {
        ActionUser
    },
    data() {
        return {
            columns: [
                {
                    label: "ID",
                    name: "user_id",
                    orderable: true
                },
                {
                    label: "วันที่สร้าง",
                    name: "date_create",
                    orderable: true
                },
                {
                    label: "วันที่แก้ไข",
                    name: "date_modified",
                    orderable: false
                },
                {
                    label: "Username",
                    name: "username",
                    orderable: false
                },
                {
                    label: "ชื่อ",
                    name: "firstname",
                    orderable: false
                },
                {
                    label: "เพศ",
                    name: "gender",
                    orderable: false
                },

                {
                    label: "User Roles",
                    name: "user_roles.roles_name",
                    orderable: false
                },

                {
                    label: "Blocked",
                    name: "is_blocked",
                    orderable: false
                    // component: UserBlocked,
                },

                {
                    label: "Action",
                    name: "",
                    orderable: false,
                    component: ActionUser,
                    event: "click",
                    handler: this.displayRow
                }
            ]
        };
    },
    filters: {
        moment: function(date) {
            return moment(date).format("MMMM Do YYYY, h:mm:ss ");
        }
    },
    mounted() {
        this.checkFlashMessage();
    },

    methods: {
        displayRow(data) {
            alert(`You clicked row ${data.id}`);
            console.log(data);
        },
        checkFlashMessage() {
            console.log(this.success);
            console.log(this.error);
            console.log(this.errors);

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
    }
};
</script>

<style scoped>
/* stuff here */
</style>
