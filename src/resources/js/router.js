import Vue from "vue";
import Router from "vue-router";
import AdvertList from "./components/advertlist";
import CreateAdvert from "./components/createAdvert";

Vue.use(Router);

export default new Router({

    routes: [
        {
            path: "/",
            name: "adverts",
            component: AdvertList
        },
        {
            path: "/create/advert",
            name: "create",
            component: CreateAdvert
        }
    ]
});
