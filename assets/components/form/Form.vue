<template>
    <form v-if="formSchema" class="form-horizontal" @submit.prevent="submit">
        <div class="form-group" v-for="(field, key) in formSchema">
            <component :is="field.fieldType"
                       :keyField="key"
                       :type="field.type"
                       :value="field.value"
                       :name="field.name"
                       :label="field.label"
                       :disabled="disabled"
                       :for-text="field.name"
                       :isRequired="field.required"
                       :options="field.options"
                       @change="fieldChange"
            />
        </div>
    </form>
</template>

<script>
import Input from './fields/Input.vue';
import Label from './fields/Label.vue';
import DatePicker from './fields/DatePicker.vue';
import Button from './fields/Button.vue';
import InputLabel from './fields/InputLabel.vue';
import DatePickerLabel from './fields/DatePickerLabel.vue';
import TimePickerLabel from './fields/TimePickerLabel.vue';
import TimePicker from './fields/TimePicker.vue';
import SingleSelect from './fields/SingleSelect.vue';
import SingleSelectLabel from './fields/SingleSelectLabel.vue';

export default {
    name: "Form",
    components: {
        Input,
        InputLabel,
        DatePicker,
        DatePickerLabel,
        Label,
        Button,
        TimePicker,
        TimePickerLabel,
        SingleSelect,
        SingleSelectLabel
    },
    props: {
        formSchema: {
            type: Object
        },
    },
    data: function () {
        return {
            formData: {},
            disabled: false
        }
    },
    created() {
        if (this.formSchema) {
            for (const [key, field] of Object.entries(this.formSchema)) {
                if(field.hasConfirm){
                    this.formData[key] = {};
                    this.formData[key]['first'] = '';
                    this.formData[key]['second'] = '';
                } else if ((field.required && field.required !== false) || field.required !== false) {
                    this.formData[key] = field.value ? field.value : '';
                }
            }
        }
    },
    methods: {
        submit() {
            this.$emit('submit', this.formData);
        },
        fieldChange(key, value) {
            if (!this.formSchema[key].isConfirm && !this.formSchema[key].hasConfirm) {
                this.formData[key] = value;
            } else if (this.formSchema[key].hasConfirm) {
                this.formData[key].first = value;
            } else if (this.formSchema[key].isConfirm) {
                const field = this.formSchema[key].confirmField;
                this.formData[field].second = value;
            }
        }
    }
}
</script>

<style scoped>

</style>