import Vue from 'vue';
import Router from 'vue-router';
import Bezoeker from './views/Bezoeker.vue';
import BezoekerHome from './views/bezoeker/Home';
import BezoekerAanbod from './views/bezoeker/Aanbod';
import BezoekerRegistreren from './views/bezoeker/Registreren';
import BezoekerLogin from './views/bezoeker/Login';
import Deelnemer from "./views/Deelnemer";
import DeelnemerActiviteiten from './views/deelnemer/Activiteiten';
import DeelnemerAccountWijzigen from './views/deelnemer/AccountWijzigen';
import Medewerker from "./views/Medewerker";
import MedewerkerActiviteiten from './views/medewerker/activiteiten/overzicht';
import MedewerkerActiviteitenDetail from './views/medewerker/activiteiten/Detail';
import MedewerkerActiviteitenBeheer from './views/medewerker/activiteiten/Beheer';
import MedewerkerActiviteitenEdit from './views/medewerker/activiteiten/Edit';
import MedewerkerActiviteitenAdd from './views/medewerker/activiteiten/Add';


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
        {
            name: "Deelnemer",
            path: "/user/",
            component: Deelnemer,
            children: [
                {
                    path: "activiteiten",
                    name: "DeelnemerActiviteiten",
                    component: DeelnemerActiviteiten,
                },
                {
                    path: "account_wijzigen",
                    name: "DeelnemerAccountWijzigen",
                    component: DeelnemerAccountWijzigen,
                }
            ]
        },
        {
            name: "Medewerker",
            path: "/admin/",
            component: Medewerker,
            children: [
                {
                    path: "activiteiten",
                    name: "MedewerkerActiviteiten",
                    component: MedewerkerActiviteiten,
                },
                {
                    path: "activiteiten/:id/detail",
                    name: "MedewerkerActiviteitenDetail",
                    component: MedewerkerActiviteitenDetail,
                },
                {
                    path: "activiteiten/:id/edit",
                    name: "MedewerkerActiviteitenEdit",
                    component: MedewerkerActiviteitenEdit,
                },
                {
                    path: "activiteiten/beheer",
                    name: "MedewerkerActiviteitenBeheer",
                    component: MedewerkerActiviteitenBeheer,
                },
                {
                    path: "activiteiten/add",
                    name: "MedewerkerActiviteitenAdd",
                    component: MedewerkerActiviteitenAdd,
                }
            ]
        }
    ]
})
