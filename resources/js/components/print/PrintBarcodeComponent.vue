<template>
    <barcode 
    :value="barcode" 
    :format="format"
    :textmargin="textmargin"
    :height="height"
    :width="width"
    :margin="margin"
    :fontSize="fontsize"
    >
    </barcode>
</template>

<script>
import VueBarcode from 'vue-barcode';
export default {
    props: ["barcode", "format", "textmargin", "fontoptions", "height", "width", "margin", "fontsize", "font"],
    components: {
        'barcode': VueBarcode
    },
    data: function() {
        return {
    // using a Math.random function to get a random value
        // value: '',
        // tag: 'svg',
        // options: {
        //     // lineColor: '#ff7069',
        //     fontSize: fontsize,
        //     font: font,
        //     width: width,
        //     height: height,
        //     textmargin: textmargin,
        //     fontoptions: fontoptions,
        //     margin: margin,
        //     // marginBottom: 60,
        //     format: 'CODE128',
        //     // background: '#ccffff'
        // },
    }
    },
   
};
</script>

<style scoped>
</style>
