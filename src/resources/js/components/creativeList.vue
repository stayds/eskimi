<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                    Creative List
                <button type="button" class="btn-close" @click="close"> x </button>
            </header>

            <section class="modal-body">
                <div class="row">
                    <div v-for="item in list" class="col-6">
                        <div  class="card">
                            <img :src="item" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>

            </section>

<!--            <footer class="modal-footer">-->
<!--                <slot name="footer">-->
<!--                    This is the default footer!-->
<!--                </slot>-->
<!--                <button type="button" class="btn-green" @click="close">Close Modal</button>-->
<!--            </footer>-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "creativeList",
        props : {
            id: String
        },
        methods: {
            close() {
                this.$emit('close');
            },
        },
        data() {
            return {
                list: null
            }
        },
        mounted() {
            axios
                .get(`http://localhost:8000/api/adverts/${this.id}`)
                .then(response => {
                    console.log(response.data);
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
    .modal-backdrop {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal {
        background: #FFFFFF;
        box-shadow: 2px 2px 20px 1px;
        overflow-x: hidden;
        display: flex;
        width: 60%;
        left: 15%;
        top: 10%;
        overflow-y: auto ;
        height: 60%;
        flex-direction: column;
    }

    .modal-header,
    .modal-footer {
        padding: 15px;
        display: flex;
    }

    .modal-header {
        position: relative;
        border-bottom: 1px solid #eeeeee;
        color: #4AAE9B;
        justify-content: space-between;
    }

    .modal-footer {
        border-top: 1px solid #eeeeee;
        flex-direction: column;
        justify-content: flex-end;
    }

    .modal-body {
        position: relative;
        padding: 20px 10px;
    }

    .btn-close {
        position: absolute;
        top: 0;
        right: 0;
        border: none;
        font-size: 20px;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        color: #4AAE9B;
        background: transparent;
    }

    .btn-green {
        color: white;
        background: #4AAE9B;
        border: 1px solid #4AAE9B;
        border-radius: 2px;
    }
</style>
