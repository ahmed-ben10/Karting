<template>
    <div>
        <InputLabel :for-text="forText"
                    :label="label"
                    :name="name"
                    :type="type"
                    :key-field="keyField + '[first]'"
                    class="form-group"
                    @change="fieldChange"/>
        <InputLabel :for-text="forTextSecond"
                    :label="labelSecond"
                    :name="nameSecond"
                    :type="type"
                    :key-field="keyField + '[second]'"
                    class="form-group"
                    @change="fieldChange"/>
    </div>
</template>

<script>
import InputLabel from "./InputLabel";

export default {
    name: "ConfirmLabel",
    components: {
        InputLabel
    },
    props: {
        type: {
            default: String,
            required: false
        },
        name: {
            type: String,
            required: false
        },
        nameSecond: {
            type: String,
            required: false
        },
        forText: {
            type: String,
            required: false
        },
        forTextSecond: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: true
        },
        labelSecond: {
            type: String,
            required: true
        },
        keyField: {
            type: String,
            required: true
        }
    },
    created() {
        this.$emit('change', this.keyField, this.confirmValue);
    },
    data: function () {
        return {
            confirmValue: {
                first: '',
                second: ''
            }
        }
    },
    methods: {
        fieldChange(key, value) {
            if (key.includes('[first]')) this.confirmValue.first = value;
            if (key.includes('[second]')) this.confirmValue.second = value;
            this.$emit('change', this.keyField, this.confirmValue);
        }
    }
}
</script>

<style scoped>

</style>