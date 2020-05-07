<template>
    <div>
        <select class="form-control" name="selectShelfUnit[]" v-model="selectVal" @click="focusUnit($event)" @select="selectEvent($event)">
            <option
                v-for="i in parseInt(data)"
                :value="i"
                :key="i"
                :selected="select == i"
            >
                {{ i }}
            </option>
        </select>
    </div>
</template>
<script>
export default {
    props: ["data", "select", "value"],
    data: function() {
        return {
            msg: "Loading...",
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },
    methods: {
        focusUnit($event) {
            console.log('---- focus -----');

            console.log('focus old value ==> ' + $event.target.value);
            this.$emit('focusUnit', $event.target.value);
        },
        selectEvent($event) {
            console.log('------ select event -------');
        }
    },
    computed: {
            selectVal: {
                get() {return this.value},
                set(selectVal) { 
                    console.log('--- emit set ---');
                    this.$emit('input', selectVal)

                }
            }
    },
    // watch: {
    //     selectVal: function(newVal, oldVal) {
    //         console.log('- watch - => old : ' + oldVal);
    //         this.$emit('oldValueData', oldVal, newVal);
    //     }
    // }
};
</script>

<style scoped>
/* stuff here */
</style>
