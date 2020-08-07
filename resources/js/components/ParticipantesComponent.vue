<template>
    <div>
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
                        <div v-if="update.success" class="alert alert-success alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Exito!</h4>
                        <span v-text="update.messaje"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="card">
                            <div class="card-header">
                               <div class="d-flex align-items-center">
                                    <h4 class="card-title">Lista de Participantes</h4>
                                    <button class="btn btn-primary btn-round ml-auto" @click="nuevo = !nuevo">
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
    </div>
    
</template>

<script>
    import datables from "datatables.net-bs4";
    import select2  from "select2";
    export default {

        data() {
            return {
                persona:{
                    id: null,
                    personal_id: null,
                    asistencia: 0,
                    event_id: this.$route.params.id,
                },
                nombre: '',
                update:{
                    success: false,
                    messaje: ''
                },
                errors: {
                    personal_id: null,
                },
                nuevo: false
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
                    "url": "/api/asistencias/evento/"+this.persona.event_id,
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
                                cheack = '<button type="button" data-toggle="tooltip" class="btn btn-icon btn-round btn-warning invalidar" data-original-title="No asistío">'+
                                    '<i class="fa fa-times"></i>'+
                                '</button>';
                            } else {
                               cheack = '<button type="button" data-toggle="tooltip" class="btn btn-icon btn-round btn-success validar" data-original-title="Si asistío">'+
                                    '<i class="fa fa-check"></i>'+
                                '</button>'+
                                '<button type="button" data-toggle="tooltip" class="btn btn-icon btn-round btn-danger eliminar" data-original-title="Eliminar">'+
                                    '<i class="fa fa-trash"></i>'+
                                '</button>';
                            }
                            return '<div class="form-button-action">'+
                                cheack+
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
                    { "data": "acredita",
                        "render": function (data) { 
                            if (data) {
                                return 'SI'
                            } else {
                                return 'NO'
                            }
                        } 
                    }
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
            acciones: function(tbody, table){
                let vue = this; //variable para poder utilizar "this" dentro de JQuery
                $(tbody).on('click', 'button.validar', function() {
                    let data =table.row($(this).parents("tr")).data();
                    vue.limpiarInputs();

                    vue.persona.id = data.id;
                    vue.persona.asistencia = 1;
                    vue.persona.personal_id = data.personal_id;

                    vue.updateAsistente();
                });
                $(tbody).on('click', 'button.invalidar', function() {
                    let data =table.row($(this).parents("tr")).data();
                    vue.limpiarInputs();

                    vue.persona.id = data.id;
                    vue.persona.asistencia = 0;
                    vue.persona.personal_id = data.personal_id;

                    vue.updateAsistente();
                });
                $(tbody).on('click', 'button.eliminar', function() {
                    var data =table.row($(this).parents("tr")).data();
                    swal({
                        title: "¿Esta seguro de Eliminar?",
                        text: data.NOMBRES+" "+data.APELLIDOS+" será eliminado y no podrá deshacer la acción!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) { 
                            let url = '/api/asistencias/'+data.id;
                            axios.delete(url)
                            .then(res => {
                                swal("Poof! Ha eliminado a "+data.NOMBRES+" "+data.APELLIDOS+"!", {
                                        icon: "success",
                                    });
                                $('#tblParticipantes').DataTable().ajax.reload();
                            })
                            .catch(err => {
                                console.error(err); 
                            })                 
                        }
                    });
                });
            },
            crearAsistente: function () {
                this.limpiarInputs();               

                let url = '/api/asistencias';
                axios.post(url, this.persona)
                .then(response => {
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

            updateAsistente: function () { 
                let url = '/api/asistencias/'+this.persona.id
                axios.put(url, this.persona)
                .then(response=>{
                    let datos = response.data;
                    this.update.success = true;
                    this.update.messaje = 'Datos actualizados correctamente: '+datos.persona;
                    $('#tblParticipantes').DataTable().ajax.reload();
                })
            },

            limpiarInputs(){
                $('.has-error').removeClass('has-error');
                $('.has-success').removeClass('has-success');
                $('.is-invalid').removeClass('is-invalid');
                this.errors.personal_id = null;
                this.update.success = false;
                this.update.messaje = '';

            },
            limpiarDatos(){
                $('#selectParticipantes').val(null).trigger('change');
                this.persona.personal_id= null;
            }
        }
    }
</script>
