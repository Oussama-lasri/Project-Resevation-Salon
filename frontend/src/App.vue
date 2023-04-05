

<template>
    <navbar />
    <router-view />

</template>
<style></style>
<script>


import navbar from './Components/navbar.vue'

export default {
    name: 'App',
    data() {
        return {

        }

    },
    mounted() {

    },
    components: {
        navbar,
        
    },
    



}

</script>