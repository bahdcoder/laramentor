import "./bootstrap";

import Vue from "vue";
import VueRouter from "vue-router";
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);
Vue.use(VueRouter);

import RequestPool from "./components/RequestPool.vue";
import Request from "./components/Request.vue";
import Layout from "./components/Layout";
import NotFound from "./components/404.vue";
import RequestButtons from "./components/RequestButtons.vue";
import SingleRequest from "./components/SingleRequestModal.vue";
import RequestFilters from "./components/RequestFilters.vue";
import VerticalNavbar from "./components/VerticalNavbar.vue";

const routes = [
    {
        path: "/request-pool",
        component: RequestPool
    },
    {
        path: "*",
        component: NotFound
    }
];

Vue.component("vue-request", Request);
Vue.component("vertical-navbar", VerticalNavbar);
Vue.component("vue-request-buttons", RequestButtons);
Vue.component("vue-single-request", SingleRequest);
Vue.component("vue-request-filters", RequestFilters);

jQuery.extend(true, jQuery.fn.datetimepicker.defaults, {
    icons: {
        up: "fas fa-arrow-up",
        down: "fas fa-arrow-down"
    }
});

const app = new Vue({
    el: "#app",
    components: {
        Layout
    },
    router: new VueRouter({
        routes,
        mode: "history",
        linkActiveClass: 'active'
    })
});
