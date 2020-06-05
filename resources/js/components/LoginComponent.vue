<template>
    <!-- @submit.prevent="login" -->
    <form
        class="form-inline"
        id="form-login">
        <input
            id="email"
            v-model="email"
            type="email"
            name="email"        
            class="form-control mr-sm-2"
            placeholder="Correo Electrónico">
            <span v-if="errors.email" class="invalid-feedback" role="alert">
                <strong>{{ errors.email }}</strong>
            </span>
        <input
            id="password"
            v-model="password"
            type="password"
            name="password"        
            class="form-control mr-sm-2"
            placeholder="Contraseña">
        <span v-if="errors.password" class="invalid-feedback" role="alert">
            <strong>{{ errors.password }}</strong>
        </span>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ingresar</button>
    </form>

</template>

<script>
    export default {
        data() {
            return {
                errors: {
                    email: null,
                    password: null 
                },
                email: null,
                password: null
            }
        },
        methods: {
            login: function() {
                axios.post('/login', $('#form-login').serialize())
                .then(res=>{
                    // console.log("sin error: "+res);
                    // this.$router.Push('http://ensycap.test/test') 
                    window.location.href = "https://sarhpro.com"
                })
                .catch(error => {
                    let datos = error.response.data.errors;

                    if (datos.email) {
                        this.errors.email = datos.email[0];
                        $('#email').addClass('is-invalid');
                    }

                    if (datos.password) {
                        this.errors.password = datos.password[0]
                        $('#password').addClass('is-invalid');
                    }
                    
                });
            }
        }
    }
</script>