<template>
    <div v-if="user" class="container" id="app" style="background-color: white">
        <header>
            <div class="row" style="margin-top: 20px">

                <div class="hidden-xs col-sm-2 ">
                    <img :src="host + '../build/img/logo.png'" alt="kartcentrum" class="pull-left img-responsive ">
                </div>
                <div class="col-sm-10">
                    <h1>Kartcentrum <span class="text-danger"> MAX</span></h1>
                </div>

            </div>
            <notifications group="message"/>
        </header>
        <nav class="navbar navbar-default" style="margin-bottom: 0px">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <router-link :to="{name: 'DeelnemerActiviteiten'}" class="navbar-brand">
                        <span class="glyphicon glyphicon-fire"></span>
                    </router-link>
                </div>

                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li>
                            <router-link :to="{name: 'DeelnemerActiviteiten'}" class="dropdown-item">
                                Home
                            </router-link>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-cog" style="color:gray"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <router-link :to="{name: 'DeelnemerAccountWijzigen'}" class="dropdown-item">
                                    Wijzig account
                                </router-link>
                                <a class="dropdown-item" @click.prevent="logout">Uitloggen</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <figure>
            <img style="margin-bottom: 20px" class="img-responsive" :src="host + '../build/img/kart-wide.jpg'"/>
        </figure>
        <router-view :user="user"></router-view>
    </div>
</template>

<script>
import store from "../store/store";
import {mapGetters, mapActions} from 'vuex';

export default {
    name: "Deelnemer",
    store: store,
    data: function () {
        return {
            user: null
        }
    },
    created() {
        this.getUser().then(res => {
            this.user = res;
        }).catch(() => {
            this.$router.push({name: 'BezoekerHome'})
        })
    },
    computed: {
        host() {
            return window.location.origin.concat('/');
        }
    },
    methods: {
        ...mapActions({
            logoutUser: 'user/logout',
            getUser: 'user/getUser'
        }),
        logout() {
            this.logoutUser().then(() => {
                this.$notify({
                    group: 'message',
                    title: 'Uitgelogd',
                    type: 'success',
                    duration: 10000
                })
                this.$router.push({name: 'BezoekerHome'})
            })
        },
    }
}
</script>

<style>

</style>