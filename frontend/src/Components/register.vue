<template>
  <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md" method="post">
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          First Name
        </label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
          type="text" placeholder="Jane" v-model="first_name">
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
          Last Name
        </label>
        <input v-model="last_name"
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          type="text" placeholder="Doe">
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Phone
        </label>
        <input v-model="phone"
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          type="number" placeholder="XX-XXXXXXXX">
      </div>
    </div>
    <button class="bg-black w-20 h-10 rounded-md text-white" @click="addUser()">submit</button>
  </div>
</template>

<script>
export default {
  name: 'register',
  data() {
    return {
      first_name: null,
      last_name: null,
      phone: null,
      token : '',
    }
  },
  
  methods: {
    async addUser() {
      await fetch('http://localhost/brief-8-Resevation-Salon/backend/Users/addUser', {
        method: 'POST',
        body: JSON.stringify({
          first_name: this.first_name,
          last_name: this.last_name,
          phone: this.phone,
        })
      }).then(response => response.json() ).then(data => this.token = data.user.token )
            localStorage.setItem('token',this.token);
      this.$router.push('token');
    },
    async getUser() {
      await fetch('http://localhost/brief-8-Resevation-Salon/backend/Users/getUser')
      .then(response => response.json())
      .then(data => console.log(data))
    }
  }
}
</script>

<style></style>