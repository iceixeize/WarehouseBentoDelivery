<template>
    <div v-if="message.length > 0">
        <div v-if="type == 'danger'">
            <b-alert show variant="danger">
                <span v-for="(error, index) in message"
                    >{{ error }}<br
                /></span>
            </b-alert>
        </div>
        <div v-if="type == 'success'">
            <b-alert show variant="success">
                <span>{{ message }}</span>
            </b-alert>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            message: [],
            type: ""
        };
    },
    methods: {
        updateFlashMessage(data) {
            this.type = data.type;
            this.message = data.msg;

            console.log(this.message[0]);
        },
        },
    mounted() {
        Bus.$on('setFlashMessage', res => {
            this.updateFlashMessage(res);
        });
    }
};
</script>
