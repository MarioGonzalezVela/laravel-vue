<template>
    <div>
      <nav>
        <ul>
          <li>
            <a href="#" :class="{ active: currentView === 'Productos' }" @click="currentView = 'Productos'">Productos</a>
          </li>
          <li>
            <a href="#" :class="{ active: currentView === 'Categorias' }" @click="currentView = 'Categorias'">Categorías</a>
          </li>
          <li>
            <a href="#" :class="{ active: currentView === 'Usuarios' }" @click="currentView = 'Usuarios'">Usuarios</a>
          </li>
          <li>
            <a href="#" :class="{ active: currentView === 'Carts' }" @click="currentView = 'Carts'">Carts</a>
          </li>
        </ul>
      </nav>
 
      <component :is="currentView" class="main-content"></component>
    </div>
  </template>
 
 
  <script>
  import Productos from './Productos.vue';
  import Categorias from './Categorias.vue';
  import Usuarios from './Usuarios.vue';
  import Carts from './Carts.vue';
 
  export default {
    components: {
      Productos,
      Categorias,
      Usuarios,
      Carts
    },
    data() {
      return {
        currentView: 'Productos'
      };
    }
  };
  </script>
 
  <style>
  nav ul {
    display: flex;
    gap: 10px;
    list-style: none;
    cursor: pointer;
  }
  </style>