<template>
    <div>
        <input
            class="form-control"
            :type="type"
            v-model="valueModel"
            :name="type"/>
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
        keyField: {
            type: String,
            required: true
        }
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
            this.$emit('change', this.keyField, this.valueModel);
        }
    },
    watch: {
        valueModel() {
            this.change();
        }
    }
}
</script>

<style scoped>

</style>