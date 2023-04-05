<template>
    <div class="py-8 lg:py-16 px-4 text-center mx-auto max-w-screen-md" method="post">
  <h1>Your Token</h1>
  <h2 class="">{{ token }}</h2>
</div>
</template>

<script>
export default {
    data(){
        return {
            token : ''
        }
    },
    mounted(){
        this.token = localStorage.getItem('token');
    }
}
</script>

<style>

</style>