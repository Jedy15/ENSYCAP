<template>
    <div>
        <div class="page-inner">
            <h4 class="page-title">Personal</h4>

            <div class="card border-primary">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body table-responsive">
                            <table id="tblPersonas" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Tarjeta</th>
                                        <th>Nombre</th>
                                        <th>Turno</th>
                                        <th>Codigo</th>
                                        <th>Rama</th>
                                        <th>Departamento</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Tarjeta</th>
                                        <th>Nombre</th>
                                        <th>Turno</th>
                                        <th>Codigo</th>
                                        <th>Rama</th>
                                        <th>Departamento</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                    </tr>
                                </tfoot>
                            </table>       
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                idUsuario:  '1'
            }
        },

        mounted(){
            var table = $('#tblPersonas').DataTable({
                "ajax": {
                    "url": "/api/personas/operativo",
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
                                '<button type="button" data-toggle="tooltip" class="btn btn-icon btn-round btn-secondary abrir" data-original-title="Expediente">'+
                                    '<i class="fa fa-info"></i>'+
                                '</button>'+
                            '</div>';
                        }
                    },
                    { "data": "NTarjeta" },
                    { "data": "NOMBRES", 
                        "render": function (data, type, row) {
                            return data+' '+row.APELLIDOS;
                        }
                    },
                    { "data": "Turno" },
                    { "data": "PUESTO" },
                    { "data": "NombreRama" },
                    { "data": "DEPARTAMENTO" },
                    { "data": "Telefono" },
                    { "data": "Correo" }
                ],
                "scrollX": true,
                "columnDefs": [
                    { "searchable": false, "targets": 0 },
                    { "orderable": false, "targets": 0 }
                ],
                "order": [[ 0, "desc" ]]
            });

            this.acciones("#tblPersonas tbody", table);
        },

        methods:{
            acciones: function(tbody, table){
                let vue = this; //variable para poder utilizar "this" dentro de JQuery
                $(tbody).on('click', 'button.abrir', function() {
                    let data =table.row($(this).parents("tr")).data();
                    swal('Proximamente Expediente de Capacitación');
                    // vue.limpiarInputs();

                    // vue.persona.id = data.id;
                    // vue.persona.asistencia = 1;
                    // vue.persona.personal_id = data.personal_id;

                    // vue.updateAsistente();
                });
            },

        }
    }
</script>