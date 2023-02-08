<script>
export default {
    name : 'home',
    data(){
        return {
            dt : {},

        }
    },
    methods:{
        getdata(){
            fetch('http://localhost/brief-8-Resevation-Salon/backend/Appointments/readAppointments')
            .then(res => console.log(res.json()));
        }
    },
    mounted() {
        this.getdata();
    }
}


</script>


<template>
<p>{{ dt }}</p>

</template>

<style>
</style>