<template>
  <nav class="relative z-50 flex flex-wrap items-center justify-between px-2 py-3 bg-yellow-900 mb-3">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
        <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
          href="#pablo">
          mon salon
        </a>
        <button
          class="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
          type="button" v-on:click="toggleNavbar()">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <div v-bind:class="{ 'hidden': !showMenu, 'flex': showMenu }" class="lg:flex lg:flex-grow items-center">
        <ul class="flex flex-col lg:flex-row list-none ml-auto">
          <div class="flex" v-if="checkUser()">
            <li class="nav-item">
              <router-link :to="{ name: 'reservation' }"
                class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75"
                href="#pablo">
                <i class="fab fa-facebook-square text-lg leading-lg text-white opacity-75" /><span
                  class="ml-2">reservation</span>
              </router-link>
            </li>
            <li class="nav-item">
              <div @click="logout()"
                class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                <i class="fab fa-pinterest text-lg leading-lg text-white opacity-75" /><span class="ml-2">logout</span>
            </div>
            </li>
          </div>
          <div class="flex" v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'register' }"
                class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                <i class="fab fa-pinterest text-lg leading-lg text-white opacity-75" /><span class="ml-2">register</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }"
                class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-75">
                <i class="fab fa-twitter text-lg leading-lg text-white opacity-75" /><span class="ml-2">login</span>
              </router-link>
            </li>
          </div>
        </ul>
      </div>
    </div>
  </nav>
</template>
  
<script>
export default {
  name: "slate-navbar",
  data() {
    return {
      showMenu: false
    }
  },
  methods: {
    toggleNavbar: function () {
      this.showMenu = !this.showMenu;
    },
    checkUser(){
      if (localStorage.getItem('user') !== null){
        return true
      } else {
        return false
      }
    },
    logout(){
      if (localStorage.getItem('user') !== null){
        if(confirm("logout ?")){
        localStorage.removeItem('user');
        localStorage.removeItem('token');
        location.href = '/home'
      }
      }
    }
  }
}
</script>
  