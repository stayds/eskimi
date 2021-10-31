<template>
    <div class="row">
        <div class="col-8 offset-2 mt-3">
             <h4>Create Adverts</h4>
             <form class="mt-3" enctype="multipart/form-data" style="" id="create-advert" @submit.prevent="validateForm">
                 <div class="alert alert-danger" v-if="errors.length">
                     <b>Please correct the following error(s):</b>
                     <ul>
                         <li v-for="error in errors">{{ error }}</li>
                     </ul>
                 </div>
                 <div class="alert alert-success" v-if="status">
                     {{ status }}
                 </div>

                 <div class="form-row" style="">
                     <div class="col">
                         <label class="form-label">Name of Advert</label>
                         <input type="text" class="form-control" v-model="name" name="name" placeholder="Enter name of advert">
                     </div>
                 </div>
                 <div class="form-row" style="margin-top: 10px">
                     <div class="col">
                         <label class="form-label">Start Date</label>
                         <input type="date" class="form-control" v-model="start_date" name="start_date" placeholder="Start Date">
                     </div>
                     <div class="col">
                         <label class="form-label">End Date</label>
                         <input type="date" class="form-control" v-on:change="compareDates" v-model="end_date" name="end_start" placeholder="End Date">
                     </div>
                 </div>
                 <div class="form-row" style="margin-top: 10px">
                     <div class="col">
                         <label class="form-label">Total Budget</label>
                         <input type="number" class="form-control" v-model="total_budget" v-on:blur="calculateDailyBudget" name="total_budget" placeholder="enter total budget">
                     </div>
                     <div class="col">
                         <label class="form-label">Daily Budget</label>
                         <input type="number" class="form-control" disabled v-model="daily_budget" name="daily_budget" placeholder="enter daily budget">
                     </div>
                 </div>
                 <div class="form-row" style="margin-top: 10px">
                     <div class="col">
                         <label class="form-label">File Upload</label>
                         <input type="file" multiple class="form-control" v-on:change="onChange" name="images[]">
                     </div>
                 </div>
                <button  style="margin-top: 10px" type="submit" class="btn btn-primary">Create Advert</button>
             </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "createAdvert",
        data(){
            return {
                errors: [],
                name: null,
                start_date: null,
                end_date: null,
                total_budget: null,
                daily_budget: null,
                creatives: null,
                status: null
            }
        },
        methods:{

            onChange(e) {
                this.file = e.target.files;
            },
            validateForm() {
                this.errors = [];
                if(!this.name){
                    this.errors.push('Name of advert can not be empty');
                }
                if (!this.start_date){
                    this.errors.push('Start date can not be empty');
                }
                if (!this.end_date){
                    this.errors.push('End date can not be empty');
                }
                if (!this.compareDates(this.start_date, this.end_date)){
                    this.errors.push('End date can not be less than start date')
                }
                if(!this.total_budget){
                    this.errors.push('Total budget can not be empty')
                }
                if (this.errors.length > 0){
                    return true;
                }else {
                    this.submitForm();
                }

            },
            compareDates (start, end) {
                if (new Date(start) > new Date(end)){
                    return false;
                }
                return true;
            },
            calculateDailyBudget(){

                if (this.compareDates(this.start_date, this.end_date)){

                    if (this.start_date === this.end_date){
                        this.daily_budget = this.total_budget
                    }
                    else {
                        let start = new Date(this.start_date);
                        let end = new Date(this.end_date);
                        let difference = (end - start) / (1000 * 60 * 60 * 24); //difference in days
                        this.daily_budget = this.total_budget / difference;
                    }
                }
                else {
                    this.errors = [];
                    this.errors.push('End date can not be less than start date');
                }
            },
            submitForm() {
                const config = {
                    headers: {
                       'content-type': 'multipart/form-data',
                    }
                }
                let data = new FormData();
                data.append('name', this.name);
                data.append('start_date', this.start_date);
                data.append('end_date', this.end_date);
                data.append('total_budget', this.total_budget);
                data.append('daily_budget', this.daily_budget);

                for( let i = 0; i < this.file.length; i++ ){
                    let file = this.file[i];
                    data.append('files[' + i + ']', file);
                }

                axios
                    .post('http://localhost:8000/api/adverts/create', data, config)
                    .then(response => {
                        console.log(response.data)
                        this.status = response.data.message;
                    })
                    .catch(error => {
                        console.log(error.response.data)
                        this.errors.push('Error posting data');
                    })
                    .finally(() => this.loading = false)

            }
        }
    }
</script>

<style scoped>

</style>
