<template>
    <div class="row">
        <div class="col-12 mb-2 ">
            <div data-bs-backdrop="static" data-bs-keyboard="false" class="modal" id="myModal">
                <div class="modal-dialog">
                    <form class="add-new-user modal-content pt-0">
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Assign</h5>
                            <button @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body flex-grow-1">

                            <form  @submit.prevent="save">
                                <div class="form-group">
                                    <label class="form-label" >Shipment</label>
                                    <select v-model="shipment.shp" class="form-control" required>
                                        <option v-for="ship in shipments" :value="ship.id">{{ship.shipment_id}}</option>
                                    </select>
                                </div>


                                <div class="mt-3">
                                    <button type="submit" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Save</button>
                                </div>
                            </form>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order Number</th>
                                <th>Location</th>
                                <th>status</th>
                                <th>Amount</th>
                                <th>Is Paid</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody v-if="orders.length > 0">
                            <tr v-for="(order,key) in orders" :key="key">
                                <td>{{ order.id }}</td>
                                <td>{{ order.order_number }}</td>
                                <td>{{ order.location }}</td>
                                <td>{{ order.status }}</td>
                                <td>{{ order.amount }}</td>
                                <td>{{ order.paid }}</td>
                                <td v-if="order.status ==='paid' ">
                                    <button @click="assign(order.id)" class="btn btn-primary btn-sm  mt-2 mb-2" data-bs-target="#myModal" data-bs-toggle="modal"> Assign To Fleet </button>
                                </td>
                                <td v-else>
                                    No Action Needed
                             </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">No Categories Found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Orders",
    data(){
        return {
            orders:[],
            fleets:[],
            shipments:[],
            shipment:{}
        }
    },
    mounted(){
        this.getOrders()
        this.getShipments()
    },
    methods:{
        async getOrders(){
            await this.axios.get('/api/order').then(response=>{
                this.orders = response.data
            }).catch(error=>{
                console.log(error)
                this.orders = []
            })
        },

        async getFleets(){
            await this.axios.get('/api/fleet').then(response=>{
                this.fleets = response.data
            }).catch(error=>{
                console.log(error)
                this.fleets = []
            })
        },
        async getShipments(){
            await this.axios.get('/api/active/shipments').then(response=>{
                this.shipments = response.data
            }).catch(error=>{
                console.log(error)
                this.shipments = []
            })
        },
        closeModal()
        {
            this.shipment = {}
        },

        save() {
            this.axios
                .patch(`/api/order/ship/${this.shipment.order}`, this.shipment)
                .then(response => {
                    alert(response.data)
                    this.getOrders()
                }).catch(error=>{
                console.log(error)
            })
        },
        assign(id){
            this.shipment.order= id
        },
    }
}
</script>

<style scoped>

</style>
