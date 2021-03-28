<template>
    <div v-if="form_schema">
        <h2>Registreren</h2>
        <Form :form-schema="form_schema" @submit="submit"/>
    </div>
</template>

<script>
import axios from 'axios';
import Form from '../../components/form/Form';

export default {
    name: "Registreren",
    components: {
        Form
    },
    data: function () {
        return {
            form_schema: {
                username: {
                    fieldType: 'InputLabel',
                    name: 'username',
                    label: 'Gebruikersnaam',
                },
                plainPassword: {
                    fieldType: 'InputLabel',
                    name: 'plain_password',
                    label: 'Wachtwoord',
                    type: 'password',
                    hasConfirm: true,
                    confirmLabel: 'Herhaal wachtwoord'
                },
                // plainPasswordRepeat: {
                //     fieldType: 'InputLabel',
                //     name: 'plain_password_repeat',
                //     label: 'Herhaal Wachtwoord',
                //     type: 'password',
                // },
                voorletters: {
                    fieldType: 'InputLabel',
                    name: 'voorletters',
                    label: 'Voorletters'
                },
                tussenvoegsel: {
                    fieldType: 'InputLabel',
                    name: 'tussenvoegsel',
                    label: 'Tussenvoegsel',
                    required: false
                },
                achternaam: {
                    fieldType: 'InputLabel',
                    name: 'achternaam',
                    label: 'Achternaam'
                },
                adres: {
                    fieldType: 'InputLabel',
                    name: 'adres',
                    label: 'Adres'
                },
                postcode: {
                    fieldType: 'InputLabel',
                    name: 'postcode',
                    label: 'Postcode'
                },
                woonplaats: {
                    fieldType: 'InputLabel',
                    name: 'woonplaats',
                    label: 'Woonplaats'
                },
                email: {
                    fieldType: 'InputLabel',
                    name: 'email',
                    label: 'Email',
                    type: 'email',
                },
                telefoon: {
                    fieldType: 'InputLabel',
                    name: 'telefoon',
                    label: 'Telefoon'
                },
                button: {
                    fieldType: 'Button',
                    label: 'Registreren',
                    required: false
                }
            }
        }
    },
    methods: {
        submit(formData) {
            axios.post('api/registreren', formData).then((res) => {
                console.log(res.data)
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