<template>
    <div>
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">{{ evento.title }}</h2>
                        <h5 class="text-white op-7 mb-2">
                            <span v-html="evento.place"></span>
                            <span v-html="evento.start"></span>
                            <span v-if="evento.end" v-html="' a '+evento.end"></span>
                        </h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <router-link :to="{name:'agenda'}" class="btn btn-white btn-border btn-round mr-2">volver</router-link>
                        <button class="btn btn-warning btn-border btn-round">editar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-participantes-tab-icon" data-toggle="pill" href="#pills-participantes-icon" role="tab" aria-controls="pills-participantes-icon" aria-selected="true">
                                        <i class="flaticon-add-user"></i>
                                        Participantes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-temas-tab-icon" data-toggle="pill" href="#pills-temas-icon" role="tab" aria-controls="pills-temas-icon" aria-selected="false">
                                        <i class="flaticon-web-1"></i>
                                        Temas
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">                        
                            <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                                <div class="tab-pane fade show active" id="pills-participantes-icon" role="tabpanel" aria-labelledby="pills-participantes-tab-icon">
                                    <participantes></participantes>
                                </div>
                                <div class="tab-pane fade" id="pills-temas-icon" role="tabpanel" aria-labelledby="pills-temas-tab-icon">
                                    <temas></temas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt--2">
                <div class="col-xs-12 col-md-6 col-lg-7">
                    <!-- <participantes></participantes> -->
                </div>
                <div class="col-xs-12 col-md-6 col-lg-5">
                    <temas></temas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            evento: '',
        }
    },
    props: ['id'],

    created: function () {
        this.getEvento();
    },

    methods:{ 
        getEvento() { 
            let url = '/api/events/'+this.id;
            axios.get(url)
            .then( data => (this.evento = data.data))
            .catch(error => console.log(error))
        }
    }
}
</script>