<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3" 
            v-for="item in list" 
            :key="item.id">

                    <router-link
                        class="card-header"
                        :to="{name: 'ponente', params:{id: item.id}}"
                        v-text="item.ponente">
                    </router-link>


                <div class="card-body">
                    <p v-text="item.email"></p>
                    <p v-text="item.usuario"></p>
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
