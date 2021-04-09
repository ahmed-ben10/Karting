<template>
    <form v-if="formSchema" class="form-horizontal" @submit.prevent="submit">
        <div class="form-group" v-for="(field, key) in formSchema">
            <component :is="field.fieldType"
                       :keyField="key"
                       :type="field.type"
                       :value="field.value"
                       :name="field.name"
                       :name-second="field.nameSecond"
                       :label="field.label"
                       :label-second="field.labelSecond"
                       :disabled="disabled"
                       :for-text="field.name"
                       :for-text-second="field.nameSecond"
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
import ConfirmLabel from './fields/ConfirmLabel.vue';

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
        SingleSelectLabel,
        ConfirmLabel
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
                if ((field.required && field.required !== false) || field.required !== false) {
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
            this.formData[key] = value;
        }
    }
}
</script>

<style scoped>

</style>