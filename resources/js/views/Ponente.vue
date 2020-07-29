<template>
    <div>
        <div class="page-inner">
            <h4 class="page-title">Ponentes</h4>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <form id="formPonente" v-on:submit.prevent="crearPonente">
                            <div class="card-header">
                                Crear Ponente
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Ponente</label>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" required class="form-control" id="ponente" name="ponente" placeholder="Ingrese Nombre" 
                                        v-model="ponente">
                                    </div>
                                    <div class="invalid-feedback" id="errorPonente"></div>                                  
                                </div>

                                <div class="form-group">
                                    <label for="">Correo Electrónico</label>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="text" required class="form-control" id="email" name="email" placeholder="Ingrese Correo"
                                        v-model="email">                                        
                                    </div>  
                                    <div class="invalid-feedback" id="errorEmail"></div>                              
                                </div>

                            </div>
                            <div class="card-footer text-muted">
                                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">               
                    <ponentes></ponentes>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                ponente:    '',
                email:      '',
                idUsuario:  '1'
            }
        },
        methods:{
            crearPonente: function() {

                $('.has-error').removeClass('has-error');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').val();

                let url = '/api/ponentes';
                const datos = {
                    user_id:    this.idUsuario,
                    ponente:    this.ponente,
                    email:      this.email
                };               

                axios.post(url, datos)
                .then(response => {
                    $('#myTable').DataTable().ajax.reload();
                    swal("Ponente Registrado", "El ponente "+this.ponente+", ha sido registrado Correctamente", "success");
                    $('#formPonente').trigger("reset");
                    this.ponente = '';
                    this.email = '';
                }).catch(e => {          
                    swal("Error","No es posible registrar ponente","error");
                    let data = e.response.data.errors;
                    if(data.ponente){
                        $('#ponente').addClass('is-invalid');
                        $('#errorPonente').html(data.ponente[0]);
                        $("#ponente").parent('.input-icon').addClass('is-invalid');
                        $("#ponente").parents('.form-group').addClass('has-error');
                    }
                    if(data.email){
                        $('#email').addClass('is-invalid');
                        $('#errorEmail').html(data.email[0]);
                        $("#email").parent('.input-icon').addClass('is-invalid');
                        $("#email").parents('.form-group').addClass('has-error');
                    }                    
                    // console.log(e);
                });
            }
        }
    }
</script>