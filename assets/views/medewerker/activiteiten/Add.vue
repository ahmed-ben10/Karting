<template>
    <div>
        <h3>Activiteit</h3>
        <Form :form-schema="form_schema" @submit="submit"/>
    </div>
</template>

<script>
import Form from "../../../components/form/Form";

export default {
    name: "Add",
    components: {
        Form
    },
    data : function () {
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
                    label: 'Limiet'
                },
                soort: {
                    fieldType: 'InputLabel',
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
    methods : {
        submit() {

        }
    }
}
</script>

<style scoped>

</style>