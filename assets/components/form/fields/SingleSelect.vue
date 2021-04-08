<template>
    <div>
        <vue-single-select :options="options"
                           v-model="valueModel"
                           :option-label="'value'"
                           placeholder="kies hier"
                           :name="name"
                           @change="change"/>
    </div>
</template>

<script>
import VueSingleSelect from "vue-single-select";

export default {
    name: "SingleSelect",
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
        keyField: {
            type: String,
            required: true
        },
        options: {
            type: Array,
            required: true
        },
    },
    components: {
        VueSingleSelect
    },
    data: function () {
        return {
            valueModel: ''
        }
    },
    created() {
        this.valueModel = this.value ? this.value : '';
    },
    methods: {
        change() {
            let value = '';
            if (this.valueModel !== null) value = this.valueModel.key;
            this.$emit('change', this.keyField, value);
        }
    },
    watch : {
        valueModel(){
            this.change();
        }
    }
}
</script>

<style scoped>
</style>