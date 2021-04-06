<template>
    <div class="col-sm-offset-2 col-sm-10">
        <button :type="type" class="btn btn-primary" :disabled="disabled">{{ label }}</button>
    </div>
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
    }
}
</script>

<style scoped>

</style>