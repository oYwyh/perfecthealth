import { createRouter, createWebHistory } from 'vue-router'
import store from './store' // import your Vuex store

const routes = [
  // your routes here
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  // Start loading
  store.commit('setLoading', true);
  next();
});

router.afterEach((to, from) => {
  // End loading
  store.commit('setLoading', false);
});

export default router
