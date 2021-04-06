<template>
    <div class="container" id="app" style="background-color: white">
        <header>
            <div class="row" style="margin-top: 20px">

                <div class="hidden-xs col-sm-2 ">
                    <img :src="host + 'build/img/logo.png'" alt="kartcentrum" class="pull-left img-responsive ">
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
                    <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-fire"></span> </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li>
                            <router-link to="/">Home</router-link>
                        </li>
                        <li>
                            <router-link to="/kartactiviteiten">Aanbod</router-link>
                        </li>
                        <li>
                            <router-link to="/registreren">Registreren</router-link>
                        </li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <router-link to="/login" active-class="active" exact>Login</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <figure>
            <img style="margin-bottom: 20px" class="img-responsive" :src="host + 'build/img/kart-wide.jpg'"/>
        </figure>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "Bezoeker",
    computed: {
        host() {
            return window.location.origin.concat('/');
        }
    }
}
</script>

<style>

</style>