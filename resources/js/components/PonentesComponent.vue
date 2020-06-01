<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" 
                v-for="item in list" 
                :key="item.id">
                    <div class="card-header" v-text="item.ponente"></div>

                    <div class="card-body">
                        <p v-text="item.email"></p>
                        <p v-text="item.usuario"></p>
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
                list:[]
            }
        },
        mounted(){
            let url = 'http://ensycap.test/api/ponentes';
            axios.get(url)
            .then((response) => {
                this.list = response.data                
            });
        }
    }
</script>
