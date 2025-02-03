<template>
    <h1>{{ titulo }}</h1>

    <div class="products-container" v-for="producto in productos">
        <p>{{ producto.id }} - {{ producto.title }}</p>
    </div>
</template>

<script>
    import axios from 'axios';

    export default{
        data(){
            return{
                titulo: "Productos",
                productos: []
            };
        },
        mounted(){
            this.getProductos();
        },

        methods:{
            async getProductos(){
                try{
                
                const response = await axios.get('api/products');
                this.productos = response.data;

            }catch(error){
                console.log('Error al hacer la petición', error);	
            }
            }
        },
    }
</script>