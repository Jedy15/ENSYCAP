<template>
    <div>
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Agenda</h2>
                        <h5 class="text-white op-7 mb-2">Agregue sus eventos de capacitación haciendo click en las fechas</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <!-- <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a> -->
                        <!-- <a href="#" class="btn btn-secondary btn-round">Add Customer</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <calendar></calendar>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>