import Vue from "vue";

export default {

    state: {
        selected_seats:[],
        taken_seats:[],
        user_id:'',
        movie_id:'',
        event_id:'',
        hall_id:'',
        date:'',
        channel:''
    },

    getters: {
    
        getSeats: state =>  state.seats,
        getTs: state =>  state.ts
        
    },

    actions: {

        // fetchCustomers({ commit }) {
        //     return axios.get('api/customers')
        //         .then(response => {
        //             commit('setCustomers', response.data);
        //         });
        // },

        fetchTakenSeats({commit,state}){            
            return axios.get('/api/seats/date/'+state.date+'/event/'+state.event_id+'/movie/'+state.movie_id+'/hall/'+state.hall_id)
                .then(response => {                    
                    state.taken_seats=response.data.data;
                    EventBus.$emit('seats_fetched');

                });
        },

        storeSelectedSeats({commit,dispatch,state}){
            if(state.selected_seats.length>0){
                let Purchase_data_obj = {
                    day:state.date,
                    event_id:state.event_id,
                    movie_id:state.movie_id,
                    hall_id:state.hall_id,
                    selected_seats:state.selected_seats
                };
    
                let Purchase_data_str = JSON.stringify(Purchase_data_obj);
                axios.post('/seats/buy',{data:Purchase_data_str})
                .then(res=>{
                    console.log('SelectedSeatsStored');
                    dispatch('clearSelectedSeats');
                    EventBus.$emit('seats_stored');
                });
            }

        },

        clearSelectedSeats({commit,state}){
            state.selected_seats=[]
        }
        
    },

    mutations: {
        set_user_id(state,payload){
            state.user_id=payload.user_id;
        },
        set_date(state,payload){
            state.date=payload.date;
        },
        set_event_id(state,payload){
            state.event_id=payload.event_id;
        },
        set_movie_id(state,payload){
            state.movie_id=payload.movie_id;
        },
        set_hall_id(state,payload){
            state.hall_id=payload.hall_id;
        },
        set_channel(state){
            state.channel = 'date_'+state.date+'_event_id_'+state.event_id+'_movie_id_'+state.movie_id+'_hall_id_'+state.movie_id;
        },
        add_selected_seat(state,payload){
            state.selected_seats.push(payload.seat_num)
        },
        remove_selected_seat(state,payload){
            
            const index = state.selected_seats.indexOf(payload.seat_num);
            if (index > -1) {
                state.selected_seats.splice(index, 1);
            }
        },
        add_taken_seat(state,payload){
            state.taken_seats.push(payload.seat_num)
        },
        remove_selected_seat_if_reserved(state,payload){
            const index = array.indexOf(payload.seat_num);
            if (index > -1) {
                state.selected_seats.splice(index, 1);
            }
            // state.taken_seats.push(payload.seat_num)
        }
    },
};