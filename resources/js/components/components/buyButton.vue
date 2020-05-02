<template>
    <div>
        <div class="mrg" >
            <button @click="buy" class="buy">Book Now {{coast}}$</button>
        </div>       
    </div>
</template>

<script>
    import  {mapState}  from 'vuex';
    import  {mapGetters}  from 'vuex';

    export default {    
          

        mounted() { 
        },
        data(){
            return{                          
            }
        },
        methods:{ 
            buy(){
                this.$store.dispatch('storeSelectedSeats');
                this.$store.dispatch('clearSelectedSeats');
            }
        },
        computed:{ 
            coast(){
                return this.$store.state.seats.selected_seats.length*15;
            }
        }
    }
</script>

<style >
.buy{
    	color:#fff;
		display:flex;
		justify-content: center;
		width: 300px;
		height: 50px;
        /* background: linear-gradient(140deg, rgb(57, 45, 209) 0%, #dd003f 100%); */
        background: #dd003f;
        border:none;
        border-radius: 20px;
        font-size: 20px;
        margin-top: 30px;
        margin-bottom: 30px
	}
</style>

