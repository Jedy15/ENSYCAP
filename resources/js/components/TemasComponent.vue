<template>
    <div>
        <div class="card-body">
            <div class="row">
                <transition name="slide-fade">
                    <div v-show="nuevo" class="col-xs-12 col-md-4">
                        <div class="card card-info bg-info-gradient">                        
                            <form v-on:submit.prevent="crearTema" id="formTemas">
                                <div class="form-group">
                                    <label text-white>Cursos</label>
                                    <select class="form-control" id="selectCursos" style="width:100%" required>
                                        <option></option>
                                    </select>
                                    <h5 class="form-text text-danger"
                                        v-if="errors.curso_id"
                                        v-text="errors.curso_id">
                                    </h5>
                                </div>
                                <div class="form-group">
                                    <label>Ponentes</label>
                                    <select class="form-control" id="selectPonentes" style="width:100%" required>
                                        <option></option>
                                    </select>
                                    <h5 class="form-text text-danger"
                                        v-if="errors.ponente_id"
                                        v-text="errors.ponente_id">
                                    </h5>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-outline-light btn-round btn-block">agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </transition>
                <div v-bind:class="[nuevo ? 'col-md-8':'', 'col-12']">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Lista de Cursos</h4>
                                <button class="btn btn-primary btn-round ml-auto" @click="nuevo = !nuevo">
                                    <i class="fa fa-plus"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="tblCursos" class="display table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Curso</th>
                                        <th>Ponente</th>
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Curso</th>
                                        <th>Ponente</th>
                                    </tr>
                                </tfoot>
                            </table>   
                        </div>
                        <div class="card-footer text-muted">
                        </div>
                    </div>                    
                </div>
            </div>
                
        </div>
    </div>
</template>

<script>
    import datables from "datatables.net-bs4";
    import select2  from "select2";
    export default {
        data(){
            return{
                tema:{
                    curso_id: null,
                    ponente_id: null,
                    event_id: this.$route.params.id,
                },
                errors:{
                    curso_id: null,
                    ponente_id: null,
                },
                curso:'',
                ponente:'',
                nuevo: false
            }
        },
        mounted(){
            var table = $('#tblCursos').DataTable({
                "ajax": {
                    "url": "/api/temas/temario/"+this.tema.event_id,
                    "dataSrc": ""
                },
                "drawCallback": function( settings ) {
					$('[data-toggle="tooltip"]').tooltip({
						container : 'body'
					});
				},
                "columns": [
                    { "data": "id",
                        "render": function ( data, type, row, meta ) {
                            return '<div class="form-button-action">'+
                                '<button type="button" data-toggle="tooltip" class="btn btn-icon btn-round btn-danger eliminar" data-original-title="Eliminar">'+
                                    '<i class="fa fa-trash"></i>'+
                                '</button>'+
                            '</div>';
                        }
                    },
                    { "data": "curso" },
                    { "data": "ponente" },
                ],

                "scrollX": true,

                "columnDefs": [
    				{ "width": "10%", "targets": 0 },
                    { "searchable": false, "targets": 0 },
                    { "orderable": false, "targets": 0 }
                ],

                "order": [[ 1, "asc" ]]
            });

            let vm = this;
            $('#selectCursos').select2({
                placeholder: "Seleccione un curso",
                allowClear: true,
                ajax:{
                    url: '/api/cursos/listar',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                }

            });

            $('#selectCursos').on('select2:select', function (e) {
                let data = e.params.data;
                vm.tema.curso_id = data.id;
            });
            
            $('#selectPonentes').select2({
                placeholder: "Seleccione ponente",
                allowClear: true,
                ajax:{
                    url: '/api/ponentes/listar',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                }

            });

            $('#selectPonentes').on('select2:select', function (e) {
                let data = e.params.data;
                vm.tema.ponente_id = data.id;
            });

			this.acciones("#tblCursos tbody", table);

        },
         methods:{
            crearTema: function () {
                this.limpiarInputs();               

                let url = '/api/temas';
                axios.post(url, this.tema)
                .then(response => {
                    this.curso = response.data.curso;
                    this.ponente = response.data.ponente;
                    $('#tblCursos').DataTable().ajax.reload();
                    this.limpiarDatos();
                })
                .catch(error => {
                    if (error.response) {
                        let data = error.response.data.errors
                        if(data.curso_id){
                            this.errors.curso_id = data.curso_id[0];
                            
                            $('#selectCursos').addClass('is-invalid');
                            $("#selectCursos").parent('.input-icon').addClass('is-invalid');
                            $("#selectCursos").parents('.form-group').addClass('has-error');
                        }
                        if(data.ponente_id){
                            this.errors.ponente_id = data.ponente_id[0];
                            
                            $('#selectPonentes').addClass('is-invalid');
                            $("#selectPonentes").parent('.input-icon').addClass('is-invalid');
                            $("#selectPonentes").parents('.form-group').addClass('has-error');
                        }
                        console.log(error.response.status);
                    }
                });
            },

            acciones: function(tbody, table){
                $(tbody).on('click', 'button.eliminar', function() {
                    var data =table.row($(this).parents("tr")).data();
                    swal({
                        title: "¿Esta seguro de Eliminar?",
                        text: data.curso+" y "+data.ponente+" será eliminado y no podrá deshacer la acción!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) { 
                            let url = '/api/temas/'+data.id;
                            axios.delete(url)
                            .then(res => {
                                swal("Poof! Ha eliminado a "+data.curso+" y "+data.ponente+"!", {
                                        icon: "success",
                                    });
                                $('#tblCursos').DataTable().ajax.reload();
                            })
                            .catch(err => {
                                console.error(err); 
                            })                 
                        }
                    });
                });
            },

            limpiarInputs(){
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.is-invalid').removeClass('is-invalid');
                this.errors.curso_id = null;
                this.errors.ponente_id = null;
            },

            limpiarDatos(){
                $('#selectCursos').val(null).trigger('change');
                $('#selectPonentes').val(null).trigger('change');

                this.tema.curso_id= null;
                this.tema.ponente_id= null;
            }
        }
    }
</script>

<style lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>
