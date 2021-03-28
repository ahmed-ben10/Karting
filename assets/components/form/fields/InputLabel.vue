<template>
    <div>
        <Label
            :for-text="forText"
            :label="label"/>
        <div class="col-sm-6">
            <Input :type="type"
                   :value="value"
                   :name="name"
                   :keyField="keyField"
                   :isRequired="isRequired"
                   @change="fieldChange"/>

        </div>
    </div>
</template>

<script>
import Input from "./Input";
import Label from "./Label";

export default {
    name: "InputLabel",
    props: {
        type: {
            type: String,
            default: 'text',
            required: false
        },
        value: {
            type: String,
            default: '',
            required: false
        },
        name: {
            type: String,
            required: true
        },
        isRequired: {
            type: Boolean,
            required: false,
            default: true
        },
        forText: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        keyField: {
            type: String,
            required: true
        }
    },
    components: {
        Label,
        Input
    },
    methods: {
        fieldChange(key, value) {
            this.$emit('change', key, value);
        }

    }
}
</script>

<style scoped>

</style>