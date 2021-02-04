<template>
    <div>
        <span class="like-btn" @click="LikeReceta()" :class="{ 'like-active' : isActive }"></span>

        <p> {{ cantidadLikes }} Likes</p>
    </div>
</template>

<script>
export default {
    props: ['recetaId', 'like', 'likes'],
    data: function() {
       return {
           isActive: this.like,
           totalLikes: this.likes
       }     
    },
    methods: {
        LikeReceta(){
            axios.post('/recetas/' + this.recetaId)
                .then(respuesta => {
                    
                    if(respuesta.data.attached.length > 0){
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }

                    this.isActive = !this.isActive //si es verdadero se iguala a falso y viceversa.
                })
                .catch(error =>{
                    if(error.response.status === 401){
                        window.location = '/register';
                    }
                });
        }
        
    },
        computed: {
            cantidadLikes: function() {
                return this.totalLikes
            }
        }
}
</script>