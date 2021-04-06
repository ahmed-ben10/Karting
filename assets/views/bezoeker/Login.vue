<template>
    <div>
        <h2>Inloggen</h2>
        <form class="form-horizontal" method="post" @submit.prevent="submit">
            <div class="form-group">

                <label class="control-label col-sm-2" for="username">Inlognaam:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" v-model="form.username"/>
                </div>
            </div>

            <div class="form-group">

                <label class="control-label col-sm-2" for="pwd">Wachtwoord:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pwd" name="password" v-model="form.password"/>
                </div>
            </div>
            <!--            <input type="hidden" name="_csrf_token"-->
            <!--                   value="{{ csrf_token('authenticate') }}"-->
            <!--            >-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import store from "../../store/store";
import {mapGetters, mapActions} from 'vuex';

export default {
    name: "Login",
    store: store,
    data: function () {
        return {
            form: {
                username: '',
                password: ''
            }
        }
    },
    computed: {
        ...mapGetters({
            user: 'user/getUser'
        })
    },
    methods: {
        ...mapActions({
            login: 'user/login'
        }),
        submit() {
            this.login(this.form).then(() => {
                this.$notify({group: 'message', text: 'Ingelogd', type: 'success'})

                if (this.user.roles.includes('ROLE_ADMIN')) {
                    this.$router.push({name: 'MedewerkerActiviteiten'})
                } else {
                    this.$router.push({name: 'DeelnemerActiviteiten'})
                }
            }).catch((error) => {
                this.$notify({group: 'message', text: error.response.data.error.messageKey, type: 'warn'})
            });
        }
    }
}
</script>

<style scoped>

</style>