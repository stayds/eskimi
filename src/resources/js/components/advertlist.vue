<template>
    <div class="card" style=" margin-top: 20px">
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Total Budget</th>
                        <th scope="col">Daily Budget</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in list">
                        <td scope="row">1</td>
                        <td class="text-capitalize">{{item.name}}</td>
                        <td>{{item.start_date}}</td>
                        <td>{{item.end_date}}</td>
                        <td>{{item.total_budget}}</td>
                        <td>{{item.daily_budget}}</td>
                        <td>
                            <v-button :onClick="getId">
                                <span class="text-white" :id="item.id">Uploaded Creatives</span>
                             </v-button>
                        </td>
                    </tr>
                </tbody>
    </table>
        </div>
        <div v-if="advertId">
            <v-modal
                :id = "advertId"
                v-show="isModalVisible"
                @close="closeModal"
            />
        </div>

    </div>

</template>

<script>
    import Creative from "./creativeButton";
    import CreativeList from "./creativeList";

    export default {
        name: "advertlist",
        components: {
            'v-modal':CreativeList,
            'v-button':Creative
        },
        methods: {

            getId(event) {
                this.advertId = event.target.id;
                this.isModalVisible = true;
            },
            // showModal() {
            //     console.log(event.target.id);
            //     this.advertId = 1
            //     this.isModalVisible = true;
            // },
            closeModal() {
                this.isModalVisible = false;
            }
        },
        data(){
            return {
                isModalVisible: false,
                list: null,
                loading: true,
                errored: false,
                advertId: null,
            }
        },
        mounted() {
            axios
                .get('http://localhost:8000/api/adverts/list')
                .then(response => {
                    this.list = response.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        }
    }
</script>

<style scoped>

</style>
