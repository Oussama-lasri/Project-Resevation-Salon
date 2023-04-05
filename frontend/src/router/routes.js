import {createRouter, createWebHistory } from 'vue-router'
import reservation from '../Components/reservation.vue'
import login from '../Components/login.vue'
import register from '../Components/register.vue'
import NotFound from '../Components/NotFound.vue'
import token from '../Components/token.vue'
import yourToken from '../Components/yourToken.vue'
import home from '../Components/home.vue'

const routes = [
    {
        path: '/reservation',
        name: 'reservation',
        component: reservation
    },
    {
        path: '/login',
        name: 'login',
        component: token
    },
    {
        path: '/register',
        name: 'register',
        component: register
    },
    {
        path: '/token',
        name: 'token',
        component: yourToken
    },
    {
        path: '/home',
        name: 'home',
        component: home
    },
    {
        path: '/:catchAll(.*)',
        name:'404',
        component: NotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router