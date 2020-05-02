<template>
    <div>
        <div class="mrg" >
            <div :class="seatClasse" @click="select"></div>
        </div>       
    </div>
</template>

<script>
    import  {mapState}  from 'vuex';
    import  {mapGetters}  from 'vuex';

    export default {    
         props:['seat_num'],

        mounted() {
            // console.log(this.$store.state.seats.taken_seats);
            EventBus.$on('seats_fetched',()=>{
                this.is_selected=false;
                this.check_if_taken();                
            });
            EventBus.$on('seats_stored',()=>{                
                this.check_if_taken();                
            });
            EventBus.$on('hall_btn',()=>{
                this.is_selected=false;
                this.is_taken=false
            });
            EventBus.$on('seat_was_sold',()=>{
                this.check_if_taken();
            });
            
            
            
        },
        data(){
            return{
                is_taken:false,
                is_selected:false,                               
            }
        },
        methods:{
            select(){
                if(!this.is_taken){
                    this.is_selected=!this.is_selected;
                    if(this.is_selected){
                        this.$store.commit('add_selected_seat',{seat_num:this.seat_num});
                    }
                    else if(!this.is_selected){
                        this.$store.commit('remove_selected_seat',{seat_num:this.seat_num});
                    }
                    // console.log(this.$store.state.seats.selected_seats)
                }                
            },

            check_if_taken(){
                if(this.$store.state.seats.taken_seats.includes(this.seat_num)){                    
                    this.is_taken=true;
                    // console.log('seat is nowtaken')
                    this.is_selected=false;
                }
                else{
                    this.is_taken=false;
                    // console.log('not taken')
                }
            }
           
        },
        computed:{
            is_empty(){
                return !this.is_taken&&!this.is_selected;
            },
           seatClasse(){
               return ['seat',{
                   'taken-seat':this.is_taken,
                   'selected-seat':this.is_selected,
                   'empty-seat':this.is_empty
               }];
           }
        }
    }
</script>

<style >
    .seat{
			position: relative;
            /* background: #d61818;
            background: #fff; */
			height: 25px;
			width:  30px;
            border-radius: 2px;                       
		}
	.seat:after{
            top:25px;            
			content: "";
			left: 5px;
			position: absolute;            
            /* background: #fff; */
            background: inherit;
			height: 4px;
			width:	20px;
			border-bottom-left-radius: 2px;
            border-bottom-right-radius: 2px;
        }
    .mrg{
       margin:5px; 
    }
    .taken-seat{
        background: #d61818;
    }
    .empty-seat{
        background: #fff;
    }
    .selected-seat{
        background: #ff7e41;
    }
</style>

