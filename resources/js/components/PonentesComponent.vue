<template>    
    <div class="col-12">
        <div class="card border-primary mb-3">
            <div class="card-header">Ponentes</div>
            <div class="card-body text-primary table-responsive">
                <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Acción</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Creado</th>
                            <th>Ultima Actualización</th>
                            <th>Creador</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Acción</th>
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
    </div>
</template>

<script>
    import datables from "datatables.net-bs4";
    export default {
        mounted(){
            $(function () {
                $('#myTable').DataTable({
                    "ajax": {
                        "url": "http://ensycap.test/api/ponentes",
                        "dataSrc": ""
                    },
                    "columns": [
                        { "data": "id" },
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
                });
            });
        }
    }
</script>
