<template>
    <h1>{{ titulo }}</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item">
                <td>{{ item }}</td>

                <td>
                    <button class="ver" @click="verCategoria(item)">
                        Ver
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <div v-if="productoSeleccionado" class="modal">
        <div class="modal-content">
            <span class="close" @click="cerrarModal">&times;</span>
            <h3>Detalles del Producto</h3>
            <p><strong>ID:</strong> {{ productoSeleccionado.id }}</p>
            <p><strong>Nombre:</strong> {{ productoSeleccionado.title }}</p>
            <p><strong>Precio:</strong> ${{ productoSeleccionado.price }}</p>
            <p>
                <strong>Descripción:</strong>
                {{ productoSeleccionado.description }}
            </p>
        </div>
    </div>

    <!-- Modal de edición de producto -->
    <div v-if="productoEditando" class="modal">
        <div class="modal-content">
            <span class="close" @click="cerrarModalEdicion">&times;</span>
            <h3>Editar Producto</h3>
            <form @submit.prevent="guardarEdicion">
                <label>Nombre:</label>
                <input v-model="productoEditando.title" type="text" required />
                <label>Precio:</label>
                <input
                    v-model="productoEditando.price"
                    type="number"
                    step="0.01"
                    required
                />
                <label>Descripción:</label>
                <textarea
                    v-model="productoEditando.description"
                    required
                ></textarea>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            titulo: "Categorías",
            items: [],
            itemSeleccionado: null,
        };
    },
    mounted() {
        this.getCategorias();
    },

    methods: {
        async getCategorias() {
            try {
                const response = await axios.get("api/categories");
                this.items = response.data;
            } catch (error) {
                console.log("Error al hacer la petición", error);
            }
        },
        verCategoria(item) {
            this.itemSeleccionado = item;
        },
        cerrarModal() {
            this.itemSeleccionado = null;
        },
    },
};
</script>
