<template>
    <div>
        <!-- <div class="card"> -->
            <div v-if="nombre" class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Exito!</h4>
                se ha resgitrado a <strong v-text="nombre"></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div v-show="nuevo" class="col-xs-12 col-md-4">
                        <div class="card">
                            <form v-on:submit.prevent="crearAsistente" id="formParticipante">
                                <!-- <div class="card-body"> -->
                                    <div class="form-group">
                                        <label>Personal</label>
                                        <select class="form-control" id="selectParticipantes" style="width:100%" required>
                                            <option></option>
                                        </select>
                                        <h5 class="form-text text-danger"
                                            v-if="errors.personal_id"
                                            v-text="errors.personal_id">
                                        </h5>
                                    </div>
                                <!-- </div> -->
                                <div class="card-footer text-muted">
                                    <button type="submit" class="btn btn-primary btn-block">agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div v-bind:class="[nuevo ? 'col-md-8':'', 'col-12']">
                        <div class="card">
                            <div class="card-header">
                               <div class="d-flex align-items-center">
                                    <h4 class="card-title">Lista de Participantes</h4>
                                    <button class="btn btn-primary btn-round ml-auto" v-on:click="nuevo=true">
                                        <i class="fa fa-plus"></i>
                                        Agregar
                                    </button>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="tblParticipantes" class="display table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Acciones</th>
                                            <th>Asistencia</th>
                                            <th>Tarjeta</th>
                                            <th>Nombre</th>
                                            <th>Turno</th>
                                            <th>Departamento</th>
                                            <th>Perfil</th>
                                            <th>Acreditado</th>
                                        </tr>
                                    </thead>
                                    
                                    <tfoot>
                                        <tr>
                                            <th>Acciones</th>
                                            <th>Asistencia</th>
                                            <th>Tarjeta</th>
                                            <th>Nombre</th>
                                            <th>Turno</th>
                                            <th>Departamento</th>
                                            <th>Perfil</th>
                                            <th>Acreditado</th>
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
        <!-- </div> -->
    </div>
    
</template>

<script>
    import datables from "datatables.net-bs4";
    import select2  from "select2";
    export default {

        data() {
            return {
                persona:{
                    personal_id: null,
                    event_id: this.$route.params.id,
                },
                nombre: '',
                errors: {
                    personal_id: null,
                },
                nuevo: false,
                claseTabla:''
            }
        },
        mounted(){
            let vm = this;
            $('#selectParticipantes').select2({
                placeholder: "Seleccione una persona o ingrese caracter",
                allowClear: true,
                ajax:{
                    url: '/api/personas',
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

            $('#selectParticipantes').on('select2:select', function (e) {
                let data = e.params.data;
                vm.persona.personal_id = data.id;
		    });
            
            var table = $('#tblParticipantes').DataTable({
                "ajax": {
                    "url": "/api/asistencias/evento/1",
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
                            let cheack = '';
                            if (row.asistencia) {
                                cheack = '<button type="button" data-toggle="tooltip" class="btn btn-link btn-warning validar" data-original-title="No asistío">'+
                                    '<i class="fa fa-times"></i>'+
                                '</button>';
                            } else {
                               cheack = '<button type="button" data-toggle="tooltip" class="btn btn-link btn-success invalidar" data-original-title="Si asistío">'+
                                    '<i class="fa fa-check"></i>'+
                                '</button>';
                            }
                            return '<div class="form-button-action">'+
                                cheack+
                                '<button type="button" data-toggle="tooltip" class="btn btn-link btn-danger eliminar" data-original-title="Eliminar">'+
                                    '<i class="fa fa-trash"></i>'+
                                '</button>'+
                            '</div>';
                        }
                    },
                    { "data": "asistencia",
                        "render": function(data, type, row){
                            if (data) {
                               return '<span class="badge badge-success"><i class="far fa-smile"></i> SI</span>';
                            } else {
                                return '<span class="badge badge-danger"><i class="far fa-frown"></i> NO</span>';
                            }
                        } 
                    },
                    { "data": "NTarjeta" },
                    { "data": null,
                        "render": function(data, type, row){
                            return row.NOMBRES+' '+row.APELLIDOS;
                        } 
                    },
                    { "data": "Turno" },
                    { "data": "DEPARTAMENTO" },
                    { "data": "NombreRama" },
                    { "data": "acredita" }
                ],

                "scrollX": true,

                "columnDefs": [
    				{ "width": "10%", "targets": 0 },
                    { "searchable": false, "targets": 0 },
                    { "orderable": false, "targets": 0 }
                ],

                "order": [[ 2, "asc" ]]
            });

			this.acciones("#tblParticipantes tbody", table);


        },
        methods:{
            crearAsistente: function () {
                this.limpiarInputs();               

                let url = '/api/asistencias';
                axios.post(url, this.persona)
                .then(response => {
                    console.log(response);
                    this.nombre = response.data.persona;
                    $('#tblParticipantes').DataTable().ajax.reload();
                    this.limpiarDatos();
                })
                .catch(error => {
                    if (error.response) {
                        let data = error.response.data.errors
                        if(data.personal_id){
                            this.errors.personal_id = data.personal_id[0];
                            $('#selectParticipantes').addClass('is-invalid');
                            $("#selectParticipantes").parent('.input-icon').addClass('is-invalid');
                            $("#selectParticipantes").parents('.form-group').addClass('has-error');
                        } 
                        console.log(error.response.status);
                    }
                });
            },

            acciones: function(tbody, table){
                $(tbody).on('click', 'button.validar', function() {
                    var data =table.row($(this).parents("tr")).data();
                    console.log(data);
                });
                $(tbody).on('click', 'button.invalidar', function() {
                    var data =table.row($(this).parents("tr")).data();
                    console.log(data);

                });
                $(tbody).on('click', 'button.eliminar', function() {
                    var data =table.row($(this).parents("tr")).data();
                    console.log(data);

                });
            },

            limpiarInputs(){
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.is-invalid').removeClass('is-invalid');
                this.errors.personal_id = null;
            },
            limpiarDatos(){
                $('#selectParticipantes').val(null).trigger('change');
                this.persona.personal_id= null;
            }
        }
    }
</script>
