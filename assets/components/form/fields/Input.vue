<template>
    <div>
        <input
            class="form-control"
            :type="type"
            v-model="valueModel"
            :name="type"
            @keyup="change">
    </div>
</template>

<script>
export default {
    name: "Input",
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
        keyField: {
            type: String,
            required: true
        }
    },
    data: function () {
        return {
            valueModel: '',
            error: null
        }
    },
    created() {
        this.valueModel = this.value ? this.value : '';
    },
    methods: {
        change() {
            this.$emit('change', this.keyField, this.valueModel);
        }
    }
}
</script>

<style scoped>

</style>