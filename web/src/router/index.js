import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/offers',
      name: 'offers',
      component: () => import('../views/OffersView.vue')
    },
    {
      path: '/offers/category/:categoryId',
      name: 'offers-by-category',
      component: () => import("@/views/OffersByCategoryView.vue"),
      props: true
    },
    {
      path: '/demands',
      name: 'demands',
      component: () => import('../views/DemandsView.vue')
    },
    {
      path: '/events',
      name: 'events',
      component: () => import('../views/EventsView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
      props: {
        activeTabProp: "login"
      }
    },
    {
      path: '/sign-up',
      name: 'sign-up',
      component: () => import('../views/LoginView.vue'),
      props: {
        activeTabProp: "register"
      }
    }
  ]
})

export default router
