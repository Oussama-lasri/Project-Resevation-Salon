<template>
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
        <div class="w-full md:w-1/2 mb-6 md:mb-0 py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <label class="block uppercase text-center tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-first-name">
                token
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                type="text" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" v-model="token">
            <button class="bg-black w-20 h-10 rounded-md text-white" @click="checkToken()">submit</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            toke: '',
        }
    },
    methods: {
        async checkToken() {
            const res = await fetch('http://localhost/brief-8-Resevation-Salon/backend/Users/checkToken' ,{
                method: 'Post',
                body: JSON.stringify({
                    token:this.token
                })
            })
                .then(response => response.json());
            localStorage.setItem('user', JSON.stringify(res.user));
            location.href = '/reservation'
        }
    }

}
</script>

<style></style>