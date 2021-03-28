<template>
    <button :type="type" class="btn btn-primary" @click="submit" :disabled="disabled">{{ label }}</button>
</template>

<script>
export default {
    name: "Button",
    props: {
        type: {
            type: String,
            default: 'button',
            required: false
        },
        label: {
            type: String,
            required: true
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    methods: {
        submit() {
            this.$emit('submit');
        }
    }
}
</script>

<style scoped>

</style>