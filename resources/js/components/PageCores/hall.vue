<template>
    <div class="main-pg">
        <!-- seats container -->
        <div class="hall-padding" >
            <!-- halls_json -->
            <div class="d-flex justify-center hall-btns">
                <hallBtn v-for="(hall,i) in halls_json" 
                    :index='i' 
                    :hall_id='hall.id' 
                    :hall_name='hall.hall_name' 
                    :key="i">
                </hallBtn>
                <!-- <hallBtn :hall_num='2'></hallBtn>
                <hallBtn :hall_num='3'></hallBtn>
                <hallBtn :hall_num='4'></hallBtn> -->
            </div>
            <!-- screen -->
            <div class="d-flex justify-center">
                <div class="screen">
                    SCREEN
                </div>
            </div>
            
            <!-- seats layout -->
            <div class="d-flex justify-center">
                <div>
                    <div v-for="(num,i) in column_num" :key="i" class="d-flex space-btwn-rows">

                        <span v-if="num=='*'" class="text-dark" style="margin-right:10px;color:#0e1720">
                            {{num}}
                        </span>

                        <span v-else class="text-white" style="margin-right:10px">
                            {{num}}
                        </span>
                        
                        <span v-for="(char,j) in row_chars" :key="j">

                            <span v-if="num=='*'">
                                <span v-if="char==''" class="d-flex justify-center empty-char-container text-white">
                                    {{char}}
                                </span>  
                                <span v-else class="d-flex justify-center char-container text-white">
                                    {{char}}
                                </span>                            
                            </span>

                            <span v-else-if="num == 0">
                                <span v-if="char=='A'">
                                    <div class="not-seat"></div>
                                </span>

                                <span v-else-if="char=='C'">
                                    <div class="not-seat"></div>
                                </span>

                                <span v-else-if="char=='G'">
                                    <div class="not-seat"></div>
                                </span>

                                <span v-else-if="char=='I'">
                                    <div class="not-seat"></div>
                                </span>

                                <span v-else-if="char==''">
                                    <div class="empty-col"></div>
                                </span>

                                <span v-else>
                                    <seat :seat_num='char+num'></seat>
                                </span>
                            </span>

                            <span v-else-if="char==''">
                                <div class="empty-col">

                                </div>
                            </span>
                            <span v-else>
                                <seat :seat_num='char+num'></seat>
                            </span>
                        </span>                         
                    </div>                    
                </div>       
                                       
            </div> 
            <!-- seats simpols -->
            <div class="d-flex justify-center">
                <div class="d-flex  seat-conds text-white">
                    <div class="d-col-flex align-center ">
                        <div class="cond empty"></div>
                        <div>Empty</div>                        
                    </div>
                    <div class="d-col-flex align-center ">
                        <div class="cond selected"></div>
                        <div>Selected</div>                        
                    </div>
                    <div class="d-col-flex align-center ">
                        <div class="cond taken"></div>
                        <div>Taken</div>                        
                    </div>
                </div>
            </div>
           <!-- buy button -->
            <div class="d-flex justify-center">
                <buyBtn>
                </buyBtn>  
            </div>           
            
        </div> 
        
    </div>
</template>

<script>
    import  {mapState}  from 'vuex';
    import  {mapGetters}  from 'vuex';

    export default {
        props:['user_id','date','event_id','halls','movie_id'],

        created(){
            this.setDefaultVuexVals();
        },
        mounted() {                        
            

            console.log(this.channel)

            Echo.channel(this.channel) 
            .listen('.ReserveEvent',e => {
                // console.log('event'+e[0])
                this.$store.commit('add_taken_seat',{seat_num:e[0]});
                this.$store.commit('remove_selected_seat_if_reserved',{seat_num:e[0]});
                EventBus.$emit('seat_was_sold');
            });
        },
        data(){
            return{
                row_chars:['A','B','','C','D','E','F','G','','H','I'],
                column_num:['*',0,1,2,3,4,5,6,7,8,9],
                halls_json:JSON.parse(this.halls),
                

            }
        },
        methods:{
            setDefaultVuexVals(){
                this.$store.commit('set_user_id',{user_id:this.user_id});
                this.$store.commit('set_date',{date:this.date});
                this.$store.commit('set_event_id',{event_id:this.event_id});
                this.$store.commit('set_movie_id',{movie_id:this.movie_id});
                this.$store.commit('set_hall_id',{hall_id:this.halls_json[0].id});
                this.$store.commit('set_channel');
                this.$store.dispatch('fetchTakenSeats');
            }
           
        },
        computed:{
            ...mapState({
                channel :state =>state.seats.channel,
             }),
            
        }
    }
</script>

<style>
    .hall-btns{
        margin-top: 10px;
    }
    .screen{
        width:400px ;
        /* border: 10px; */
        border-style: solid;
        border-top-width: 7px;
        border-color:rgb(57, 45, 209);
        border-top-left-radius: 50%;
        border-top-right-radius: 50%;
        margin:30px;
        text-align: center;
        color:#fff;
        padding-top: 7px
    }
    .seat-conds{
        margin-top: 20px;
        width:300px;
        justify-content: space-between
    }
    .cond{
        background: #fff;
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    
    .d-inline-flex{
        display: inline-flex
    }
    .d-col-flex{
        display: flex;
        flex-direction: column;
    }
    .d-flex{
        display: flex;
    }
    .justify-center{
        justify-content: center;
    }
    .align-center{
        align-items: center
    }
    .char-container{
        width:40px ;
    }
    .hall-padding{
        padding: 10px
    }
    .not-seat{
        width: 40px;
        height: 35px
    }
    .space-btwn-rows{
        margin-bottom: 10px;

    }
    .text-white{
        color: #fff;
    }
    .txt-dark{
        color: #0e1720
    }
    .empty{
        background: #fff;
    }
    .taken{
         background: #d61818;
    }
    .selected{
        background: #ff7e41;
    }
</style>