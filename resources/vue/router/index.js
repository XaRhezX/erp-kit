import { createRouter, createWebHistory } from 'vue-router';
import routes from '~pages';

console.log(routes);

const Router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes  // config routes
})

export default Router;
