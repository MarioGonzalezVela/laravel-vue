<template>
    <h1>{{ titulo }}</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="producto in productos" :key="producto.id">
                <td>{{ producto.id }}</td>
                <td>{{ producto.title }}</td>
                <td>${{ producto.price }}</td>
                <td>
                    <button class="ver" @click="verProducto(producto)">
                        Ver
                    </button>
                </td>
                <td>
                    <button class="editar" @click="editarProducto(producto)">
                        Editar
                    </button>
                </td>
                <td>
                    <button
                        class="eliminar"
                        @click="eliminarProducto(producto.id)"
                    >
                        Eliminar
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            titulo: "Productos",
            productos: [],
        };
    },
    mounted() {
        this.getProductos();
    },

    methods: {
        async getProductos() {
            try {
                const response = await axios.get("api/products");
                this.productos = response.data;
            } catch (error) {
                console.log("Error al hacer la petición", error);
            }
        },
    },
};
</script>
