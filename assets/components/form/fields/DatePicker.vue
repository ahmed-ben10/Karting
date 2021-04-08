<template>
    <datepicker :value="value"
                :name="name"
                :placeholder="'dd-mm-yyyy'"
                :format="'dd-MM-yyyy'"
                :input-class="'form-control'"
                v-model="valueModel"
                @closed="change"/>
</template>

<script>
import Datepicker from 'vuejs-datepicker';

export default {
    name: "DatePicker",
    components: {
        Datepicker
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
        this.valueModel = this.value ? this.value : '';
    },
    methods: {
        customFormatter() {
            let date = new Date(this.valueModel);
            return this.pad2(date.getDate()) + '-' + this.pad2(date.getMonth() + 1) + '-' + this.pad2(date.getFullYear());
        },
        pad2(n) {
            return (n < 10 ? '0' : '') + n;
        },
        change() {
            if (this.valueModel) {
                let date = this.customFormatter();
                this.$emit('change', this.keyField, date);
            }
        }
    }
}
</script>

<style scoped>

</style>