<template>
    <div>
        <h2>Registreren</h2>
        <form class="form-horizontal" method="post" @submit.prevent="submit">
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Inlognaam:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" v-model="form.username" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="plain_password">Wachtwoord:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="plain_password" name="plain_password" v-model="form.plainPassword" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="plain_password_repeat">Herhaal wachtwoord:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="plain_password_repeat" name="plain_password_repeat" v-model="form.plainPasswordRepeat" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="voorletters">Voorletters:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="voorletters" name="voorletters" v-model="form.voorletters" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Tussenvoegsel:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" v-model="form.tussenvoegsel" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="achternaam">Achternaam:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="achternaam" name="achternaam" v-model="form.achternaam" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="adres">Adres:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="adres" name="adres" v-model="form.adres" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="postcode">Postcode:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="postcode" name="postcode" v-model="form.postcode" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="woonplaats">Woonplaats:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="woonplaats" name="woonplaats" v-model="form.woonplaats" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="email" name="email" v-model="form.email" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="telefoon">Telefoon:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="telefoon" name="telefoon" v-model="form.telefoon" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Registreren</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Registreren",
    data: function () {
        return {
            form: {
                username: '',
                plainPassword: '',
                plainPasswordRepeat: '',
                voorletters: '',
                tussenvoegsel: '',
                achternaam: '',
                adres: '',
                postcode: '',
                woonplaats: '',
                email: '',
                telefoon: ''
            }
        }
    },
    methods: {
        submit() {
            axios.post('api/login', this.form).then((res) => {
                if (res.data.error) {
                    this.$notify({group: 'message', text: res.data.error.message})
                }
            }).catch((error) => {
                console.error(error)
            });
        }
    }
}
</script>

<style scoped>

</style>