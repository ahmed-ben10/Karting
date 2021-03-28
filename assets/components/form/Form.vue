<template>
    <form v-if="formSchema" class="form-horizontal">
        <div class="form-group" v-for="(field, key) in formSchema">
            <component :is="field.fieldType"
                       :keyField="key"
                       :type="field.type"
                       :value="field.value"
                       :name="field.name"
                       :isRequired="field.required"
                       :label="field.label"
                       :disabled="disabled"
                       :for-text="field.name"
                       @submit="submit"
                       @change="fieldChange"/>
        </div>
    </form>
</template>

<script>
import Input from './fields/Input.vue';
import Label from './fields/Label.vue';
import Button from './fields/Button.vue';
import InputLabel from './fields/InputLabel.vue';

export default {
    name: "Form",
    components: {
        Input,
        InputLabel,
        Label,
        Button
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