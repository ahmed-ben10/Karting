<template>
    <div class="container">
        <router-view></router-view>
        <hr>
        <footer>
            <img class="pull-right img-thumbnail" width="40" style="margin-top: -10px;margin-bottom: 10px"
                 :src="host + 'build/img/linkedin.jpg'"/>
            <img class="pull-right img-thumbnail" width="40" style="margin-top: -10px;margin-bottom: 10px"
                 :src="host + 'build/img/tweet.jpg'"/>
            <img class="pull-right img-thumbnail " width="40" style="margin-top: -10px;margin-bottom: 10px"
                 :src="host + 'build/img/pinterest.png'"/>
            <p class="text-muted text-center">
                &copy;afdeling applicatieontwikkelaar Tinwerf 10, 2544 ED Den Haag. Telefoon:088 666 3600
            </p>
        </footer>
    </div>
</template>

<script>
export default {
    name: "App",
    computed: {
        host() {
            return window.location.origin.concat('/');
        }
    }
}
</script>

<style scoped>

</style>