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
            required: false
        }
    },
    data: function () {
        return {
            valueModel: ''
        }
    },
    created() {
        this.valueModel = this.value;
    },
    methods: {
        change() {
            const value = this.type === 'number'
                ? parseInt(this.valueModel)
                : this.valueModel;
            this.$emit('change', this.keyField, value);
        }
    },
    watch: {
        valueModel() {
            this.change();
        },
        value(newVal) {
            this.valueModel = newVal;
        }
    }
}
</script>

<style scoped>

</style>