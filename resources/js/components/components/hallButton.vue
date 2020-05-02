<template>
    <div>
        <div class="mrg" >
            <button @click="click" :class="hallClass">{{hall_name}}</button>
        </div>       
    </div>
</template>

<script>

    import  {mapState}  from 'vuex';
    import  {mapGetters}  from 'vuex';

    export default {    
          
        props:['hall_id','index','hall_name'],

        mounted() { 
            if(this.index==0){
                this.is_clicked=true
            }
            
            EventBus.$on('hall_btn',data=>{
                // console.log(data);
                if(data != this.hall_id)
                {
                    this.is_clicked=false;
                }
            });
        },

        data(){
            return{     
                is_clicked:false,                     
            }
        },
        methods:{ 
            click(){
                if(!this.is_clicked){
                    this.$store.commit('set_hall_id',{hall_id:this.hall_id})
                    this.$store.dispatch('fetchTakenSeats');
                }
                this.is_clicked=true;
                 this.$store.state.seats.hall_id=this.hall_id
                // console.log(this.$store);
                EventBus.$emit('hall_btn',[this.hall_id]);                                
            }
        },
        computed:{ 
            hallClass(){
                return this.is_clicked ? 'btn-click': 'btn';
            }
        }
    }
</script>

<style scoped>
    .btn{
			height: 40px;
			width: 70px;
			background: #233a50 ;
			border: none;
			color:#fff;
        }
        
    .btn-click{
			height: 40px;
			width: 70px;
			background: #dd003f;
			border: none;
			color:#fff;
    }

    button {        
        outline: none;
        border: none;
        margin-right: 10px;
        margin-left: 10px;
        border-radius: 2px;
    }
</style>

