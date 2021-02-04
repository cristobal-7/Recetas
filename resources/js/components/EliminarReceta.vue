<template>
    <input 
    type="submit"
    class="btn btn-danger d-block w-100 mb-2" 
    value="Eliminar ×"
    v-on:click.prevent="eliminarReceta()"
    >
</template>

<script>
export default {
    props: ['recetaId'],
    mounted(){
        console.log('receta actual', this.recetaId)
    },
    methods: {
        eliminarReceta(){
            /**  La idea esinstalar un plugins - https://www.npmjs.com/package/vue-sweetalert2 
            # bash 
                npm install -S vue-sweetalert2
            */    
        }
    }
}
</script>