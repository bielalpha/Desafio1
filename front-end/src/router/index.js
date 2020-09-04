import Vue from 'vue'
import VueRouter from 'vue-router'
import PortoEmbarque from '../views/PortoEmbarque.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/PortoEmbarque',
    name: 'PortoEmbarque',
    component: PortoEmbarque
  }
]

const router = new VueRouter({
  routes
})

export default router
