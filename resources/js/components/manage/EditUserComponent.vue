<template>
    <div class="container-sm">
        <b-jumbotron header-level="5" bg-variant="white">
            <template v-slot:header>User data</template>
            <hr class="my-4" />
            <b-form>
            <b-container fluid>
                <b-row class="my-1">
                    <b-col sm="3">
                        <label>ชื่อ <code>*</code
                            > :</label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            type="text"
                            :value="auth_user.firstname"
                        ></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label>นามสกุล <code>*</code
                            > :</label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            type="text"
                            :value="auth_user.lastname"
                        ></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label>เลขประจำตัวประชาชน <code>*</code
                            > :</label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            type="text"
                            :value="auth_user.id_card"
                        ></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label>เพศ <code>*</code
                            > :</label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-select v-model="genderSelected" :options="genderOptions"></b-form-select>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label>วันเกิด <code>*</code
                            > :</label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            type="date"
                            :value="auth_user.birthday"
                        ></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label>เบอร์โทรศัพท์ <code>*</code
                            > :</label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-input
                            type="text"
                            :value="auth_user.tel"
                        ></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1" v-if="roleOptions.length > 0">
                    <b-col sm="3">
                        <label>User Roles <code>*</code
                            > :</label
                        >
                    </b-col>
                    <b-col sm="9">
                        <b-form-select v-model="roleSelected" :options="roleOptions"></b-form-select>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col sm="9" offset-sm="3" class="mt-3">
                        <b-button variant="danger">แก้ไข</b-button>
                        <b-button variant="light" type="reset">ยกเลิก</b-button>

                    </b-col>
                </b-row>
            </b-container>
            </b-form>
        </b-jumbotron>
    </div>
</template>

<script>
export default {
    props: ["errors", "error", "success", "auth_user", "user_roles"],
    components: {},
    data() {
        return {
            genderSelected: this.auth_user.gender,
            genderOptions: [
                { value: 'male', text: 'ชาย' },
                { value: 'female', text: 'หญิง' },
            ],

            roleSelected: this.auth_user.user_roles_id,
            roleOptions: [],
            
        };
    },
    mounted() {
        console.log(this.user_roles);
        if(this.user_roles.length > 0) {
            let vueInstance = this;
            this.user_roles.forEach(element => vueInstance.roleOptions.push({value: element.user_roles_id, text: element.roles_name}));
        }
    },

    methods: {}
};
</script>

<style scoped>
/* stuff here */
</style>
