<template>
  <div>
      45e45q4we54w5
    <label class="mt-3" for="datepicker-dateformat2">Short date format</label>
    <b-form-datepicker
      id="datepicker-dateformat2"
      :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
      locale="en"
    ></b-form-datepicker>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        value: ''
      }
    }
  }
</script>