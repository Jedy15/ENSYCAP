<template>
    <div>
        <!-- <div class="card"> -->
            <div class="card-header">
				<div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Participantes</h4>
                    <div class="card-tools">
                        <!-- <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-user-plus"></span></button> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <form v-on:submit.prevent="crearAsistente">
                                <!-- <div class="card-body"> -->
                                    <div class="form-group form-floating-label">
                                        <select class="form-control input-border-bottom" id="selectParticipantes" required
                                            v-model="persona.personal_id">
                                            <option value="">&nbsp;</option>
                                            <option value="250">T647 Jorge Eduardo Hernández Gómez</option>
                                            <option value="251">T600 Eduardo Gómez</option>
                                            <option value="1">T666 Hola Mundo</option>
                                        </select>
                                        <label for="selectFloatingLabel" class="placeholder">Buscar Personal</label>
                                    </div>
                                <!-- </div> -->
                                <div class="card-footer text-muted">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                                <div class="card-body text-primary table-responsive">
                                    <table id="tblParticipantes" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Tarjeta</th>
                                                <th>Nombre</th>
                                                <th>Turno</th>
                                                <th>Departamento</th>
                                                <th>Perfil</th>
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Tarjeta</th>
                                                <th>Nombre</th>
                                                <th>Turno</th>
                                                <th>Departamento</th>
                                                <th>Perfil</th>
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
    export default {

        data() {
            return {
                persona:{
                    personal_id: null,
                    event_id: this.$route.params.id,
                    // asistencia: false,
                    // acredita: false,
                    // constancia: null,
                    // libro: null,
                }
            }
        },
        mounted(){
            // var editar = function (tbody, table){
            //     $(tbody).on('click', 'button.editar', function() {
            //         var data =table.row($(this).parents("tr")).data();
            //         $('#mId').val(data.id);
            //         $('#mPonente').val(data.ponente);
            //         $('#mEmail').val(data.email);
            //         $('#mUser_id').val(1);
            //         $('#modalEditar').modal('show');
            //     });
            // }

            // var eliminar = function (tbody, table){
            //     $(tbody).on('click', 'button.eliminar', function() {
            //         var data =table.row($(this).parents("tr")).data();
            //         // $('#mId').val(data.id);
            //         swal({
            //             title: "¿Esta seguro de Eliminar?",
            //             text: "El ponente "+data.ponente+", ya no estará visible en la asignación de ponente!",
            //             icon: "warning",
            //             buttons: true,
            //             dangerMode: true,
            //             })
            //             .then((willDelete) => {
            //                 if (willDelete) { 
            //                     let url = '/api/ponentes/'+data.id;
            //                     axios.delete(url)
            //                     .then(res => {
            //                         swal("Poof! Ha eliminado al Ponente "+data.ponente+"!", {
            //                                 icon: "success",
            //                             });
            //                         $('#tblParticipantes').DataTable().ajax.reload();
            //                     })
            //                     .catch(err => {
            //                         console.error(err); 
            //                     })                 
            //                 }
            //             });
            //     });
            // }
            $(function () {
                var table = $('#tblParticipantes').DataTable({
                    // "ajax": {
                    //     "url": "/api/ponentes",
                    //     "dataSrc": ""
                    // },
                    // "columns": [
                    //     { "data": "id",
                    //         "render": function ( data, type, row, meta ) {
                    //             return '<div class="btn-group btn-group-sm" role="group"><button type="button" class="editar btn btn-warning">Editar</button><button type="button" class="eliminar btn btn-danger">Borrar</button></div>';
                    //         }
                    //     },
                    //     { "data": "ponente" },
                    //     { "data": "email" },
                    //     { "data": "created_at" },
                    //     { "data": "updated_at" },
                    //     { "data": "usuario" }
                    // ],

                    "scrollX": true,

                    "columnDefs": [
                        { "searchable": false, "targets": 0 },
                        { "orderable": false, "targets": 0 }
                    ],

                    "order": [[ 0, "desc" ]]
                });

                // editar("#tblParticipantes tbody", table);
                // eliminar("#tblParticipantes tbody", table);
            });
        },
        methods:{
            crearAsistente: function () {
                let url = '/api/asistencias';
                axios.post(url, this.persona)
                .then(response => {
                    swal("Exito", "Agregado Correctamente", "success");
                })
                .catch(error => { console.log(error); });
            }
            // editarPonente: function() {
            //     $('.has-error').removeClass('has-error');
            //     $('.is-invalid').removeClass('is-invalid');
            //     $('.invalid-feedback').val();

            //     const datos = $("#mFormEdit").serialize();
            //     let url = '/api/ponentes/'+$('#mId').val();
            //     axios.put(url, datos)
            //     .then(response => {
            //         let datos = response.data;
            //         swal("Ponente Actualizado", "El ponente: "+ datos.ponente +", ha sido Actualizado Correctamente", "success");
            //         $('#tblParticipantes').DataTable().ajax.reload();
            //         $('#mFormEdit').trigger("reset");
            //         $('#modalEditar').modal('hide');

            //     }).catch(e => {
            //         let errores = e;
            //         if(errores.message){
            //             let data = e.response.data.errors;
            //             if(data.ponente){
            //                 $('#mPonente').addClass('is-invalid');
            //                 $('#mErrorPonente').html(data.ponente[0]);
            //                 $("#mPonente").parents('.form-group').addClass('has-error');
            //             }
            //             if(data.email){
            //                 $('#mEmail').addClass('is-invalid');
            //                 $('#mErrorEmail').html(data.email[0]);
            //                 $("#mEmail").parents('.form-group').addClass('has-error');
            //             }
            //             swal("Error",errores.message,"error");
            //         } else {
            //             console.log(errores);
            //         }
            //     });

            // }
        }
    }
</script>
