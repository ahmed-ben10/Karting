import Vue from 'vue';
import Router from 'vue-router';
import Bezoeker from './views/Bezoeker.vue';
import BezoekerHome from './views/bezoeker/Home';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            name: "Bezoeker",
            path: "/",
            component: Bezoeker,
            children: [
                {
                    path: "/",
                    name: "BezoekerHome",
                    component: BezoekerHome,
                }
            ]
        },
    ]
})
