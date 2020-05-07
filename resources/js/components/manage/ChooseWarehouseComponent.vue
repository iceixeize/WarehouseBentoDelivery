<template>
    <div class="container-sm">
        <div class="jumbotron bg-white text-danger">
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3 auto">
                    <div class="card text-white bg-danger mb-3 text-center" v-for="warehouse in laravelData.data" :key="warehouse.warehouse_id">
                        <div class="card-header">
                            <!-- <a target="_blank" :href="warehouse.subdomain + '.bentodelivery.com'" class="btn btn-danger"> -->
                                <h4 class="pt-2" @click="chooseWarehouse(warehouse.subdomain)" style="cursor: pointer;"> Warehouse : {{ warehouse.warehouse_name }} ({{warehouse.warehouse_id}}) </h4>
                            <!-- </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <pagination
            :data="laravelData"
            @pagination-change-page="getResults"
        ></pagination>
    </div>
</template>

<script>

export default {
    
    props: [],
    components: {
    },
    data() {
		return {
			// Our data object that holds the Laravel paginator data
            laravelData: {},
		}
	},

	mounted() {
		// Fetch initial results
        this.getResults();
        
        // this.$http.get('', function(tips){
        //     console.log(tips);
        //     // this.$set('tips', tips)
        // });
	},

	methods: {
		// Our method to GET results from a Laravel endpoint
		getResults(page = 1) {
			axios.get('choosewarehouse?page=' + page)
				.then(response => {
					this.laravelData = response.data.data;
				});
        },
        chooseWarehouse(subdomain = '') {
            console.log('subdomain :: ' + subdomain + '.bentodelivery.com');
            let link = 'http://' + subdomain + '.bentodelivery.com';
            // console.log(link);
            // window.locaiton.href = link;
            // var currentUrl = window.location.pathname;
            // console.log('current : ' + currentUrl);
            // location.replace(subdomain + '.bentodelivery.com');
            // window.open(subdomain + '.bentodelivery.com');
            //  window.open(link);
            window.location.href = link;
        }
	}
};
</script>

<style scoped>
/* stuff here */
</style>
