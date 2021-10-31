<template>
    <div>
    <nav class="nav">
        <router-link class="nav-link" to="/">Advert List</router-link>
        <router-link class="nav-link" to="/create/advert">Create Advert</router-link>
    </nav>
    <router-view/>
    </div>
</template>

<script>
    export default {
        name: "navigation"
    }
</script>

<style scoped>

</style>
