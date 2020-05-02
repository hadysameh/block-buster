<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body" >
                        I'm an example component.
                        {{seats}}
                        {{seat}}
                        {{getTs}}
                        <button @click="xtest">ttt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import  {mapState}  from 'vuex';
    import  {mapGetters}  from 'vuex';

    export default {
        mounted() {
            console.log('Component mounted.')
            // console.log(mapState)
            // console.log(store)
            Echo.channel('reserve') 
            .listen('.ReserveEvent',e => {
                console.log(e)
                // console.log('something')
            });
        },
        data(){
            return{
                seats:[0]
            }
        },
        methods:{
            test(){
                // console.log('triggered')
                axios.get('/index23').then((e)=>console.log(e));
            },
            xtest(){
                //$ is used with objects tat are public to all vue components
                this.seats=this.$store.getters.getSeats
                this.$store.commit('increment',2)
            }
        },
        computed:{
            ...mapState({
                seat:state=>state.seats.seats
            }),
            ...mapGetters([
                'getTs'
            ])
        }
    }
</script>
