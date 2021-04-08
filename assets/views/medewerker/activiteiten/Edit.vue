<template>
    <div>
        <h3>Activiteit</h3>
        <Form :form-schema="form_schema" @submit="submit"/>
    </div>
</template>

<script>
import Form from "../../../components/form/Form";
import store from "../../../store/store";
import {mapActions, mapGetters} from "vuex";
import axios from "axios";

export default {
    name: "Edit",
    store: store,
    components: {
        Form
    },
    data: function () {
        return {
            form_schema: {
                datum: {
                    fieldType: 'DatePickerLabel',
                    name: 'datum',
                    label: 'Datum',
                },
                tijd: {
                    fieldType: 'TimePickerLabel',
                    name: 'tijd',
                    label: 'Tijd',
                },
                limiet: {
                    fieldType: 'InputLabel',
                    name: 'username',
                    type: 'number',
                    label: 'Limiet',
                },
                soort: {
                    fieldType: 'SingleSelectLabel',
                    options: [],
                    name: 'soort',
                    label: 'Soort'
                },
                button: {
                    fieldType: 'Button',
                    label: 'Aanmaken',
                    type: 'submit',
                    required: false
                }
            }
        }
    },
    computed: {
        ...mapGetters({
            activiteiten: 'activiteiten/getActiviteiten',
        })
    },
    created() {
        this.getById(this.$route.params.id).then(res => console.log(res));
        this.fillData();
    },
    methods: {
        ...mapActions({
            loadData: 'activiteiten/loadData',
            edit: 'activiteiten/edit',
            getById: 'activiteiten/getById'
        }),
        async fillData() {
            let soortActiviteiten = [];
            let options = [];

            await axios.get('/api/admin/soort_activiteiten').then(res => {
                soortActiviteiten = res.data.soortActiviteit;
            })

            for (let i = 0; i < soortActiviteiten.length; i++) {
                options.push({
                    key: soortActiviteiten[i].id,
                    value: soortActiviteiten[i].naam
                });
            }

            this.form_schema.soort.options = options;
        },
        submit(formData) {
            this.edit(id, formData).then(res => {
                this.$notify({
                    group: 'message',
                    title: res.title,
                    type: 'success',
                    duration: 10000
                })
                this.$router.push({name: 'MedewerkerActiviteiten'});
            }).catch(error => {
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