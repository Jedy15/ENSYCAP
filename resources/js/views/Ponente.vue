<template>
    <div>
        <div class="page-inner">
            <h4 class="page-title">Ponentes</h4>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <form v-on:submit.prevent="crearPonente">
                            <div class="card-header">
                                Nuevo Ponente
                            </div>
                            <div class="card-body">
                                    <p v-if="errores.length">
                                        <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                                        <ul>
                                            <li v-for="error in errores">{{ error }}</li>
                                        </ul>
                                    </p>

                                    <div class="form-group">
                                        <label for="">Ponente</label>
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="ponente" name="ponente" placeholder="Ingrese Nombre" 
                                            v-model="ponente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Correo Electrónico</label>
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese Correo"
                                            v-model="email">
                                        </div>
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
                idUsuario:  '1',
                errores:[]
            }
        },
        methods:{
            crearPonente: function() {
                let url = '/api/ponentes/';
                const datos = {
                    user_id:    this.idUsuario,
                    ponente:    this.ponente,
                    email:      this.email
                };               

                axios.post(url, datos)
                .then(response => {
                    this.RecargarPonentes();
                }).catch(e => {                    
                    let data = e.response.data.errors;
                    if(data.ponente){
                        this.errores.push(data.ponente[0]); 
                        this.inputError(ponente);
                    }
                    if(data.email){
                        this.errores.push(data.email[0]);
                        this.inputError(email);
                    }
                    
                    console.log(e.response.message);
                });
            },
            inputError:function(input) {
                $(input).addClass('is-invalid');
                let grupo = $(input).parents(".form-group");                
                $(grupo).addClass('has-error');
            },
            RecargarPonentes: function() {
                $('#myTable').DataTable().ajax.reload();
            },
            getPonente: function () {
                let url = '/api/ponentes/' + this.id;
                axios.get(url)
                .then(response=>{
                    this.item = response.data
                });
            }
        }
    }
</script>