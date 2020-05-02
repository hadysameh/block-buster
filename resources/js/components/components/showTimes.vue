<template>
    <div>
        <h2>Choose A day</h2>
        <br>
        <select name="" id="" v-model="selceted_date" v-on:change="set_first_option">
            <option v-for="(date,j) in filtered_dates" :key="j">{{date}}</option>
        </select>
        
        <br>  
        <h2>Choose An Event</h2>
        <br>
        
        <select name="" id="" v-model="event_id">
            <option v-for="(event,j) in date_events" :key="j" :value="event.id">{{event.duration}}</option>
        </select>

        <br>
        <br>
        
        <a v-bind:href="'/seats/date/'+selceted_date+'/event/'+event_id+'/movie/'+movie_id" class="ticket-link">get tickets now</a>

    </div>
</template>

<script>

    import  {mapState}  from 'vuex';
    import  {mapGetters}  from 'vuex';

    export default {    
          
        props:['dates','events','movie_id'],

        mounted() { 
            // console.log(this.dates)
            // console.log(this.events)
            // console.log(this.date_events)
            // console.log(this.$store)
        },

        data(){
            return{     
                // is_clicked:false,     
                selceted_date:this.dates[0].day,
                event_id:this.dates[0].event_id,                              
            }
        },
        methods:{ 
            set_first_option(){
                this.event_id=this.date_events[0].id
            }
            
        },
        computed:{ 
            
            filtered_dates(){
                let days = this.dates.map(date=>date.day);

                let unrepeated_days=[...new Set(days)];
                
                return unrepeated_days;
            },
            date_events(){

                let events_ids = this.dates.map(date=>{
                    if(date.day==this.selceted_date){
                        return date.event_id;
                    }

                });

                let events = this.events.map(event=>{
                    if(events_ids.includes(event.id)){
                        return event;
                    }
                });

                events=events.filter(event=>{
                    if(event){
                        return event
                    }
                });
                return events;
            }
        }
    }
</script>

<style scoped>
    .ticket-link{
        background: #dd003f;
        margin:100px 0px 0px 0px ;
        color: #fff;
        text-transform: capitalize;
        padding: 10px 30px 10px 30px;
        border-radius: 5px
    }
    select{
        background: #233a50 ;
        color:#fff;
        padding: 5px;
        border-color:#233a50 ;
        font-size: large
    }
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

