<template>
    <div class="row">
        <div class="col-12 mb-">
            <button class="btn btn-primary float-end mt-2 mb-2" data-bs-target="#myModal" data-bs-toggle="modal"> New  </button>
            <div data-bs-backdrop="static" data-bs-keyboard="false" class="modal modal-slide-in new-user-modal fade" id="myModal">
                <div class="modal-dialog">
                    <form class="add-new-user modal-content pt-0">
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">New </h5>
                            <button @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <form  @submit.prevent="save">

                                <div class="form-group">
                                    <label class="form-label" >Vehicle</label>
                                    <select v-model="ship.fleet_id" class="form-control" required>
                                        <option v-for="fleet in fleets" :value="fleet.id">{{fleet.vehicle_reg}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" >From</label>
                                    <select v-model="ship.from" class="form-control" required>
                                        <option>Nairobi</option>
                                        <option>Mombasa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" >To</label>
                                    <select v-model="ship.to" class="form-control" required>
                                        <option>Nairobi</option>
                                        <option>Mombasa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" >Departure Time</label>
                                    <input v-model="ship.departure_time" type="datetime-local" class="form-control" required>
                                </div>


                                <div v-if="edit === true" class="mt-3">
                                    <button type="submit" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Update</button>
                                </div>
                                <div v-else class="mt-3">
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
                    <h4>Shipments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vehicle</th>
                                <th>From</th>
                                <th>To</th>
                                <th>status</th>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody v-if="shipments.length > 0">
                            <tr v-for="(ship,key) in shipments" :key="key">
                                <td>{{ ship.shipment_id }}</td>
                                <td>{{ ship.fleet.vehicle_reg }}</td>
                                <td>{{ ship.from }}</td>
                                <td>{{ ship.to }}</td>
                                <td>{{ ship.state }}</td>
                                <td>{{ ship.departure_time }}</td>
                                <td>{{ ship.arrival_time }}</td>
                                <td>
                                    <button @click="editShipment(ship)" class="btn btn-primary btn-sm  mt-2 mb-2" data-bs-target="#myModal" data-bs-toggle="modal"> Edit </button>
                                    <button @click="deleteFleet(ship.id)" class="btn btn-danger btn-sm  mt-2 mb-2" > Delete </button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4">No Shipments Found.</td>
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
    name: "Shipment",
    data(){
        return {
            shipments:[],
            fleets:[],
            ship:{},
            states:[],
            locations:[],
            edit:false,
        }
    },
    mounted(){

        this.getShipments()
        this.getFleets()
    },
    methods:{
        async getShipments(){
            await this.axios.get('/api/shipment').then(response=>{
                this.shipments = response.data
            }).catch(error=>{
                console.log(error)
                this.shipments = []
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
        save(){
            if (this.edit === true)
            {
                this.updateShipment()

            }else {
                this.addShipment()
            }
            this.closeModal()
        },
        addShipment() {
            this.axios
                .post('/api/shipment', this.ship)
                .then(response => {
                    alert(response.data)
                    this.getShipments()
                }).catch(error=>{
                console.log(error)
            })
        },
        editShipment(ship) {
            this.ship = ship
            this.edit = true
        },
        closeModal()
        {
            this.edit=false
            this.ship={}
        },
        updateShipment() {
            this.axios
                .patch(`/api/shipment/${this.ship.id}`, this.ship)
                .then(response => {
                    alert(response.data)
                    this.getShipments()
                }).catch(error=>{
                console.log(error)
            })
        },
        deleteFleet(id){
            if(confirm("Are you sure to delete this Shipment ?")){
                this.axios.delete(`/api/shipment/${id}`).then(response=>{
                    this.getShipments()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
