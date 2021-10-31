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

    import Advertlist from "./advertlist";
    import Navigation from "./navigation";
    import CreateAdvert from "./createAdvert";

    export default {
        components: {Navigation, Advertlist, CreateAdvert}
    }
</script>
