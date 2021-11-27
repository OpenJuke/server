require('./bootstrap');

import Vue from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress';
import VueMoment from 'vue-moment';

import AppLayout from './App.vue';

InertiaProgress.init({
    color: '#FC3BB5',
    showSpinner: true
});

Vue.prototype.$route = route;

Vue.use(VueMoment);

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