<template>
  <div class="">
    <div class="page-header d-flex justify-content-between p-4 border my-2">
      <h3>Clientes</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#formClienteModal"
      >
        Crear cliente
      </button>
    </div>
    <div class="page-content mt-4">
      <section class="">
        <table class="table table-sm table-bordered table-responsive ">
          <thead>
            <tr>
              <th>id</th>
              <th>Nombres</th>
              <th>Documento</th>
              <th>Celular</th>
              <th>Correo Electronico</th>
              <th>Dirección</th>
              <th>Créditos</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="c in listaClientes.data" :key="c.id">
              <td>{{ c.id }}</td>
              <td>{{ c.nombres }} {{ c.apellidos }}</td>
              <td>{{ c.nro_documento }}</td>
              <td>( {{ c.celular1 }} ) - ( {{ c.celular2 }} )</td>
              <td>{{ c.email }}</td>
              <td>{{ c.direccion }}</td>
              <td class="text-center">
                <button class="btn btn-outline-primary">
                  <i class="bi bi-eye"></i>
                </button>
              </td>
              <td class="text-center">
                <button
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(c)"
                >
                  <i class="bi bi-pen"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
         <pagination
            :align="'center'"
            :data="listaClientes"
            :limit="8"
            @pagination-change-page="listarClientes"
          >
            <span slot="prev-nav">&lt; Previous</span>
            <span slot="next-nav">Next &gt;</span>
          </pagination>
      </section>
    </div>
    <crear-editar-cliente ref="CrearEditarCliente" @listar-clientes="listarClientes(1)" />
  </div>
</template>
<script>
import CrearEditarCliente from "./CrearEditarCliente.vue";
export default {
  components: { CrearEditarCliente },
  data() {
    return {
      listaClientes: {},
    };
  },
  created() {
    this.listarClientes(1);
  },
  methods: {
    listarClientes(page = 1) {
      let me = this;
      axios.get("api/clientes?page=" + page).then(function (response) {
        me.listaClientes = response.data;
      });
    },
    mostrarDatos: function (cliente) {
      this.$refs.CrearEditarCliente.abirEditarCliente(cliente);
    },
  },
};
</script>