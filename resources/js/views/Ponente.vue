<template>
    <div>
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading" v-text="item.ponente"></h1>
            </div>
        </section>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-4 shadow-sm">
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" 
                        xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" 
                        focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
                        <div class="card-body">
                            <p class="card-text" v-text="item.email"></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted" v-text="item.created"></small>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                    </div>
                    <hr>
                    <h2>Otro Ponentes</h2>
                    <ponentes></ponentes>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data(){
            return{
                item:{}
            }
        },
        created(){
            let url = 'http://ensycap.test/api/ponentes/' + this.id;
            axios.get(url)
            .then(response=>{
                this.item = response.data
            });
        }
    }
</script>