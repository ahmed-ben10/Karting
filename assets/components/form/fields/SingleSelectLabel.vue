<template>
    <div>
        <Label
            :for-text="forText"
            :label="label"/>
        <div class="col-sm-6">
            <SingleSelect :value="value"
                          :options="options"
                          :keyField="keyField"
                          :name="name"
                          @change="fieldChange"/>
        </div>
    </div>
</template>

<script>
import SingleSelect from "./SingleSelect";
import Label from "./Label";

export default {
    name: "SingleSelectLabel",
    props: {
        value: {
            type: String,
            default: '',
            required: false
        },
        options: {
            type: Array,
            required: true
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
        },
        name: {
            type: String,
            required: true
        }
    },
    components: {
        Label,
        SingleSelect
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