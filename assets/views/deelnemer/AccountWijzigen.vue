<template>
    <section v-if="user">
        <h3>Wijzig account</h3>
        <Form :form-schema="form_schema" @submit="submit"/>
    </section>
</template>

<script>
import axios from "axios";
import store from "../../store/store";
import Form from "../../components/form/Form";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "AccountWijzigen",
    components: {
        Form
    },
    store: store,
    props:{
        user: {
            required: true
        }
    },
    data: function () {
        return {
            form_schema: {
                username: {
                    fieldType: 'InputLabel',
                    value: this.user.username,
                    name: 'username',
                    label: 'Gebruikersnaam'
                },
                plainPassword: {
                    fieldType: 'InputLabel',
                    name: 'plainPassword',
                    label: 'Wachtwoord',
                    type: 'password',
                    hasConfirm: true
                },
                plainPasswordRepeat: {
                    fieldType: 'InputLabel',
                    name: 'plainPasswordRepeat',
                    required: false,
                    label: 'Herhaal Wachtwoord',
                    isConfirm: true,
                    confirmField: 'plainPassword',
                    type: 'password'
                },
                voorletters: {
                    fieldType: 'InputLabel',
                    value: this.user.voorletters,
                    name: 'voorletters',
                    label: 'Voorletters'
                },
                tussenvoegsel: {
                    fieldType: 'InputLabel',
                    value: this.user.tussenvoegsel,
                    name: 'tussenvoegsel',
                    label: 'Tussenvoegsel',
                    required: false
                },
                achternaam: {
                    fieldType: 'InputLabel',
                    value: this.user.achternaam,
                    name: 'achternaam',
                    label: 'Achternaam'
                },
                adres: {
                    fieldType: 'InputLabel',
                    value: this.user.adres,
                    name: 'adres',
                    label: 'Adres'
                },
                postcode: {
                    fieldType: 'InputLabel',
                    value: this.user.postcode,
                    name: 'postcode',
                    label: 'Postcode'
                },
                woonplaats: {
                    fieldType: 'InputLabel',
                    value: this.user.woonplaats,
                    name: 'woonplaats',
                    label: 'Woonplaats'
                },
                email: {
                    fieldType: 'InputLabel',
                    value: this.user.email,
                    name: 'email',
                    label: 'Email',
                    type: 'email'
                },
                telefoon: {
                    fieldType: 'InputLabel',
                    value: this.user.telefoon,
                    name: 'telefoon',
                    label: 'Telefoon'
                },
                button: {
                    fieldType: 'Button',
                    label: 'Wijzigen',
                    type: 'submit',
                    required: false
                }
            }
        }
    },
    methods: {
        ...mapActions({
            logoutUser: 'user/logout'
        }),
        submit(formData) {
            axios.post('/api/user/deelnemer/edit', formData).then((res) => {
                this.$notify({
                    group: 'message',
                    title: res.data.title,
                    type: 'success',
                    duration: 10000
                })
                this.$router.push({name: 'DeelnemerActiviteiten'})
            }).catch((error) => {
                let errors = error.response.data.errors;
                for (let key in errors) {
                    this.$notify({
                        group: 'message',
                        title: error.response.data.title,
                        text: errors[key][0],
                        type: 'warn',
                        duration: 10000
                    })
                }
            });
        }
    }
}
</script>

<style scoped>

</style>