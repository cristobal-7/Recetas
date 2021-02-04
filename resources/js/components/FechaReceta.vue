<template>

        <span> {{ formatearFecha }} </span>
    
</template>

<script>
    export default {
        created(){
              this.formatearFecha();
          },
        props: ['fecha'], /* 'fecha' -> es la propiedad de la etiqueta <fecha-receta fecha="{{$fecha}}"> en ./recetas/show.blade.php */
         /*   mounted() {
              console.log('La fecha es: ', this.fecha);
          }, */ 
          
        computed: {

            formatearFecha(){
                // codigo con momentjs
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');
                
            }
        },
    }
</script>