<template>
    <div>
        <div class="card border-primary">
            <div class="card-header">Ponentes</div>
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Creado</th>
                            <th>Ultima Actualización</th>
                            <th>Creador</th>
                        </tr>
                    </thead>
                    
                    <tfoot>
                        <tr>
                            <th>Acciones</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Creado</th>
                            <th>Ultima Actualización</th>
                            <th>Creador</th>
                        </tr>
                    </tfoot>
                </table>       
            </div>    
        </div>
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content card-warning">
                    <form id="mFormEdit" v-on:submit.prevent="editarPonente">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Ponente</h5>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="mId" name="id">
                            <input type="hidden" id="mUser_id" name="user_id">

                            <div class="form-group">
                                <label for="mPonente">Ponente</label>
                                <input type="text" class="form-control" id="mPonente" name="ponente" placeholder="Ingrese Nombre" required>
                                <div class="invalid-feedback" id="mErrorPonente"></div>                              
                            </div>

                            <div class="form-group">
                                <label for="mEmail">Correo Electrónico</label>
                                <input type="email" class="form-control" id="mEmail" name="email" placeholder="Ingrese Correo" required>
                                <div class="invalid-feedback" id="mErrorEmail"></div>                              
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-round btn-sm" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-round btn-sm">Guardar Cambios</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    import datables from "datatables.net-bs4";
    export default {
        mounted(){
            var editar = function (tbody, table){
                $(tbody).on('click', 'button.editar', function() {
                    var data =table.row($(this).parents("tr")).data();
                    $('#mId').val(data.id);
                    $('#mPonente').val(data.ponente);
                    $('#mEmail').val(data.email);
                    $('#mUser_id').val(1);
                    $('#modalEditar').modal('show');
                });
            }

            var eliminar = function (tbody, table){
                $(tbody).on('click', 'button.eliminar', function() {
                    var data =table.row($(this).parents("tr")).data();
                    // $('#mId').val(data.id);
                    swal({
                        title: "¿Esta seguro de Eliminar?",
                        text: "El ponente "+data.ponente+", ya no estará visible en la asignación de ponente!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) { 
                                let url = '/api/ponentes/'+data.id;
                                axios.delete(url)
                                .then(res => {
                                    swal("Poof! Ha eliminado al Ponente "+data.ponente+"!", {
                                            icon: "success",
                                        });
                                    $('#myTable').DataTable().ajax.reload();
                                })
                                .catch(err => {
                                    console.error(err); 
                                })                 
                            }
                        });
                });
            }
            $(function () {
                var table = $('#myTable').DataTable({
                    "ajax": {
                        "url": "/api/ponentes",
                        "dataSrc": ""
                    },
                    "columns": [
                        { "data": "id",
                            "render": function ( data, type, row, meta ) {
                                return '<div class="btn-group btn-group-sm" role="group"><button type="button" class="editar btn btn-warning">Editar</button><button type="button" class="eliminar btn btn-danger">Borrar</button></div>';
                            }
                        },
                        { "data": "ponente" },
                        { "data": "email" },
                        { "data": "created_at" },
                        { "data": "updated_at" },
                        { "data": "usuario" }
                    ],
                    "scrollX": true,
                    "columnDefs": [
                        { "searchable": false, "targets": 0 },
                        { "orderable": false, "targets": 0 }
                    ],
                    "order": [[ 0, "desc" ]]
                });

                editar("#myTable tbody", table);
                eliminar("#myTable tbody", table);
            });
        },
        methods:{
            editarPonente: function() {
                $('.has-error').removeClass('has-error');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').val();

                const datos = $("#mFormEdit").serialize();
                let url = '/api/ponentes/'+$('#mId').val();
                axios.put(url, datos)
                .then(response => {
                    let datos = response.data;
                    swal("Ponente Actualizado", "El ponente: "+ datos.ponente +", ha sido Actualizado Correctamente", "success");
                    $('#myTable').DataTable().ajax.reload();
                    $('#mFormEdit').trigger("reset");
                    $('#modalEditar').modal('hide');

                }).catch(e => {
                    let errores = e;
                    if(errores.message){
                        let data = e.response.data.errors;
                        if(data.ponente){
                            $('#mPonente').addClass('is-invalid');
                            $('#mErrorPonente').html(data.ponente[0]);
                            $("#mPonente").parents('.form-group').addClass('has-error');
                        }
                        if(data.email){
                            $('#mEmail').addClass('is-invalid');
                            $('#mErrorEmail').html(data.email[0]);
                            $("#mEmail").parents('.form-group').addClass('has-error');
                        }
                        swal("Error",errores.message,"error");
                    } else {
                        console.log(errores);
                    }
                });

            }            
        }
    }
</script>
