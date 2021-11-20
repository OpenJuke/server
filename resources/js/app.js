require('./bootstrap');

import Vue from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress';

import AppLayout from './App.vue';

InertiaProgress.init();
Vue.prototype.$route = route;

createInertiaApp({
    resolve: name => {
      const page = require(`./Pages/${name}`).default;
      if(page.layout !== false) {
        page.layout = page.layout || AppLayout;
      }
      return page;
    },
    setup({ el, App, props }) {
        new Vue({
            render: h => h(App, props),
        }).$mount(el);
    },
});