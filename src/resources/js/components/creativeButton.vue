<template>
    <button type="button" id="" @click = "onClick" class="btn btn-success btn-sm"><slot></slot></button>
</template>

<script>
    export default {
        name: "creative",
        props: {
            'advertId': Number,
            onClick: {
                type: Function
            }
        },
        data() {
            return {
                name:"View Creatives"
            }
        }
    }
</script>

<style scoped>

</style>
