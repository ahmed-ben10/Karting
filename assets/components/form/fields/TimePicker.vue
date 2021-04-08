<template>
    <timepicker
        v-model="valueModel"
        :input-class="'form-control'"
        :format="'HH:mm'"
        :name="name"
        @change="change"/>
</template>

<script>
import Timepicker from 'vue2-timepicker/src/vue-timepicker.vue'

export default {
    name: "TimePicker",
    components: {
        Timepicker
    },
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
        }
    },
    data: function () {
        return {
            valueModel: null
        }
    },
    created() {
        this.valueModel = this.value ? this.value : '00:00';
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