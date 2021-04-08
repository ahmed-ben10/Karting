<template>
    <div v-if="activiteit">
        <h3>Wijzigen {{ activiteit.soort.naam }} - ({{ activiteit.datumFormatted}} - {{ activiteit.tijdFormatted}})</h3>
        <Form :form-schema="form_schema" @submit="submit"/>
    </div>
</template>

<script>
import Form from "../../../components/form/Form";
import store from "../../../store/store";
import {mapActions, mapGetters} from "vuex";
import axios from "axios";

export default {
    name: "ActiviteitenEdit",
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
                    value: ''
                },
                tijd: {
                    fieldType: 'TimePickerLabel',
                    name: 'tijd',
                    label: 'Tijd',
                    value: ''
                },
                limiet: {
                    fieldType: 'InputLabel',
                    name: 'username',
                    type: 'number',
                    label: 'Limiet',
                    value: ''
                },
                soort: {
                    fieldType: 'SingleSelectLabel',
                    options: [],
                    name: 'soort',
                    label: 'Soort',
                    value: ''
                },
                button: {
                    fieldType: 'Button',
                    label: 'Wijzigen',
                    type: 'submit',
                    required: false
                }
            },
            activiteit: null
        }
    },
    computed: {
        ...mapGetters({
            activiteiten: 'activiteiten/getActiviteiten',
        })
    },
    created() {
        this.getOptions();
    },
    methods: {
        ...mapActions({
            loadData: 'activiteiten/loadData',
            edit: 'activiteiten/edit',
        }),
        fillData() {
            this.activiteit = this.activiteiten.find(x => x.id == this.$route.params.id);
            this.form_schema.datum.value = this.activiteit.datumFormatted;
            this.form_schema.tijd.value = this.activiteit.tijdFormatted;
            this.form_schema.limiet.value = this.activiteit.limiet.toString();
            this.form_schema.soort.value = this.activiteit.soort.naam;
        },
        async getOptions() {
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
            this.edit({data: formData, id: this.activiteit.id}).then(res => {
                this.$notify({
                    group: 'message',
                    title: res.title,
                    type: 'success',
                    duration: 10000
                })
                this.$router.push({name: 'MedewerkerActiviteitenBeheer'});
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
    },
    watch: {
        activiteiten(newVal) {
            if (newVal) {
                this.fillData();
            }
        }
    }
}
</script>

<style scoped>

</style>