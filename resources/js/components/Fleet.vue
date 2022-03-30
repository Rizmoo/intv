<template>
    <div class="row">
        <div class="col-12 mb-">
            <button class="btn btn-primary float-end mt-2 mb-2" data-bs-target="#myModal" data-bs-toggle="modal"> New Vehicle </button>
            <div data-bs-backdrop="static" data-bs-keyboard="false" class="modal modal-slide-in new-user-modal fade" id="myModal">
                <div class="modal-dialog">
                    <form class="add-new-user modal-content pt-0">
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">New Vehicle</h5>
                            <button @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body flex-grow-1">


                            <form  @submit.prevent="save">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Vehicle Reg</label>
                                    <input v-model="fleet.vehicle_reg" type="text" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Location</label>
                                    <select v-model="fleet.location" class="form-control" required>
                                        <option>Nairobi</option>
                                        <option>Mombasa</option>
                                    </select>
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
                    <h4>Fleet</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fleet Registration</th>
                                <th>Location</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody v-if="fleets.length > 0">
                            <tr v-for="(fleet,key) in fleets" :key="key">
                                <td>{{ fleet.id }}</td>
                                <td>{{ fleet.vehicle_reg }}</td>
                                <td>{{ fleet.location }}</td>
                                <td>{{ fleet.state }}</td>
                                <td>
                                    <button @click="editFleet(fleet)" class="btn btn-primary btn-sm  mt-2 mb-2" data-bs-target="#myModal" data-bs-toggle="modal"> Edit </button>
                                    <button @click="deleteFleet(fleet.id)" class="btn btn-danger btn-sm  mt-2 mb-2" > Delete </button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4">No Categories Found.</td>
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
    name: "Fleet",
    data(){
        return {
            fleets:[],
            fleet:{},
            reg:'',
            location:'',
            state:'',
            states:[],
            locations:[],
            edit:false,
        }
    },
    mounted(){

        this.getFleets()
    },
    methods:{
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
                this.updateFleet(this.fleet)

            }else {
                this.addFleet()
            }
            this.closeModal()
        },
        addFleet() {
            this.axios
                .post('/api/fleet', this.fleet)
                .then(response => {
                    alert(response.data)
                    this.getFleets()
                }).catch(error=>{
                    console.log(error)
                })
        },
        editFleet(fleet) {
            this.fleet = fleet
            this.edit = true
        },
        closeModal()
        {
            this.edit=false
            this.fleet={}
        },
        updateFleet() {
            this.axios
                .patch(`/api/fleet/${this.fleet.id}`, this.fleet)
                .then(response => {
                    alert(response.data)
                    this.getFleets()
                }).catch(error=>{
                console.log(error)
            })
        },
        deleteFleet(id){
            if(confirm("Are you sure to delete this Vehicle ?")){
                this.axios.delete(`/api/fleet/${id}`).then(response=>{
                    this.getFleets()
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
