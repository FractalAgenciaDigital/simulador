<template>
  <div>
    <div class="page-header">
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
    <div class="page-content">
      <section>
        <table class="table table-sm table-bordered table-responsive">
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
                <button class="btn btn-outline-primary">
                  <i class="bi bi-pen"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
    <crear-editar-cliente />
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
  },
};
</script>