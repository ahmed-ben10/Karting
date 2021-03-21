<template>
    <div>
        <h2>Inloggen</h2>

        <form class="form-horizontal" method="post" @submit.prevent="submit">

            <div class="form-group">

                <label class="control-label col-sm-2" for="username">Inlognaam:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username"  name="username"  v-model="form.username" required="required" />
                </div>
            </div>

            <div class="form-group">

                <label class="control-label col-sm-2" for="pwd">Wachtwoord:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pwd"  name="password" v-model="form.password" required="required" />
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

export default {
    name: "Login",
    data: function () {
        return {
            form: {
                username: '',
                password: ''
            }
        }
    },
    methods: {
        submit() {
            axios.post('api/login', this.form).then((res) => {
                console.log(res)
            }).catch((error) => {
                console.error(error)
            });
        }
    }
}
</script>

<style scoped>

</style>