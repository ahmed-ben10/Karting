<template>
    <div>
        <Label
            :for-text="forText"
            :label="label"/>
        <div class="col-sm-6">
            <TimePicker :value="value"
                        :name="name"
                        :keyField="keyField"
                        @change="fieldChange"/>
        </div>
    </div>
</template>

<script>
import Label from "./Label";
import TimePicker from "./TimePicker";

export default {
    name: "TimePickerLabel",
    props: {
        value: {
            type: String,
            default: '',
            required: false
        },
        name: {
            type: String,
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
        }
    },
    components: {
        Label,
        TimePicker
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