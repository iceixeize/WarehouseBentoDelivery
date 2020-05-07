<template>
<div class="mt-3">
    <b-button-group >
      <b-button variant="outline-secondary" @click="editData">Edit</b-button>
      <b-button variant="outline-secondary">Block</b-button>
      <b-button variant="outline-secondary">Delete</b-button>
    </b-button-group>
  </div>
</template>

<script>
export default {
    props: {
        data: {},
        name: {},
        click: {
            type: Function,
            default: () => {
                console.log('click');
            }
        },
        classes: {
            type: Object,
            default: () => ({ 
                'btn': true,
                'btn-primary': true,
                'btn-sm': true,
            }),
        },
    },
    methods: {
        editData() {
            console.log('edit data');
        }
    }
}
</script>