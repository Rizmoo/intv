<template>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <router-link to="/home" class="nav-item nav-link">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">Home</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/orders" class="nav-item nav-link">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">Orders</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/shipment" class="nav-item nav-link">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">Shipments</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/fleet" class="nav-item nav-link">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">Fleets</span>
                            </router-link>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col py-4">
                <router-view></router-view>
            </div>
        </div>
    </div>

</template>

<script>
export default {}
</script>
