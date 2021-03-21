import Vue from 'vue';
import Router from 'vue-router';
import Bezoeker from './views/Bezoeker.vue';
import BezoekerHome from './views/bezoeker/Home';
import BezoekerAanbod from './views/bezoeker/Aanbod';
import BezoekerRegistreren from './views/bezoeker/Registreren';
import BezoekerLogin from './views/bezoeker/Login';

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
                },
                {
                    path: "/kartactiviteiten",
                    name: "BezoekerAanbod",
                    component: BezoekerAanbod,
                },
                {
                    path: "/registreren",
                    name: "BezoekerRegistreren",
                    component: BezoekerRegistreren,
                },
                {
                    path: "/login",
                    name: "BezoekerLogin",
                    component: BezoekerLogin,
                },
            ]
        },
    ]
})
