<template>
    <h1>{{ titulo }}</h1>

    <div class="form-container">
        <h3>Agregar Producto</h3>
        <form @submit.prevent="agregarProducto">
            <label>Nombre:</label>
            <input v-model="nuevoProducto.title" type="text" required />
            <label>Precio:</label>
            <input v-model="nuevoProducto.price" type="number" required />
            <label>Descripción:</label>
            <textarea v-model="nuevoProducto.description" required></textarea>
            <button type="submit">Agregar</button>
        </form>
    </div>
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
            titulo: "Productos",
            productos: [],
            productoSeleccionado: null,
            productoEditando: null,
            nuevoProducto: {
                title: "",
                price: "",
                description: "",
            },
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
        verProducto(producto) {
            this.productoSeleccionado = producto;
        },
        cerrarModal() {
            this.productoSeleccionado = null;
        },
        editarProducto(producto) {
            this.productoEditando = producto;
        },
        async guardarEdicion() {
            try {
                await axios.put(
                    `/api/products/${this.productoEditando.id}`,
                    this.productoEditando
                );
                // Actualizar la lista de productos con los nuevos

                const index = this.productos.findIndex(
                    (p) => p.id === this.productoEditando.id
                );
                if (index !== -1) {
                    this.productos[index] = {
                        ...this.productoEditando,
                    };
                }
                this.cerrarModalEdicion();
            } catch (error) {
                console.error("Error al actualizar el producto:", error);
            }
        },
        cerrarModalEdicion() {
            this.productoEditando = null;
        },
        async eliminarProducto(id) {
            if (
                confirm("¿Estás seguro de que quieres eliminar este producto?")
            ) {
                try {
                    await axios.delete(`/api/products/${id}`);
                    this.productos = this.productos.filter(
                        (producto) => producto.id !== id
                    );
                } catch (error) {
                    console.error("Error al eliminar el producto:", error);
                }
            }
        },
        async agregarProducto() {
            try {
                const response = await axios.post(
                    `/api/products`,
                    this.nuevoProducto
                );
                this.productos.push(response.data);
                this.nuevoProducto = { title: "", price: "", description: "" };
            } catch (error) {
                console.error("Error al agregar producto:", error);
            }
        },
    },
};
</script>
