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
      props: true,
      alias: ['/offer/category/:categoryId']
    },
    {
      path: '/offers/tag/:tagId',
      name: 'offers-by-tag',
      component: () => import("@/views/OffersByTagView.vue"),
      props: true,
      alias: ['/offer/tag/:tagId']
    },
    {
      path: '/requests',
      name: 'requests',
      component: () => import('../views/RequestsView.vue')
    },
    {
      path: '/requests/category/:categoryId',
      name: 'requests-by-category',
      component: () => import("@/views/RequestsByCategoryView.vue"),
      props: true,
      alias: ['/request/category/:categoryId']
    },
    {
      path: '/requests/tag/:tagId',
      name: 'requests-by-tag',
      component: () => import("@/views/RequestsByTagView.vue"),
      props: true,
      alias: ['/request/tag/:tagId']
    },
    {
      path: '/offers/:advertId',
      name: 'advert-details',
      component: () => import('../views/AdvertDetailsView.vue'),
      props: true,
      alias: [
        '/offer/:advertId',
        '/request/:advertId',
        '/requests/:advertId',
      ]
    },
    {
      path: '/new-advert-form',
      name: 'new-advert-form',
      component: () => import('../views/NewAdvertFormView.vue')
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
    },
    {
      path: '/user/:userId',
      name: "user-profile",
      component: () => import("../views/UserProfileView.vue"),
      props: true
    },
    {
      path: '/update-advert/:advertId',
      name: "update-advert",
      component: () => import("../views/UpdateAdvertFormView.vue"),
      props: true
    }
  ]
})

export default router
