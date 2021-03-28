<template>
    <label class="control-label col-sm-2" :for="forText">{{ label }}</label>
</template>

<script>
export default {
    name: "Label",
    props: {
        forText: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>

</style>