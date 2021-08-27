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
                <button
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(c)"
                >
                  <i class="bi bi-pen"></i>
                </button>

                <!-- <button
                  class="btn"
                  @click="CambiarEstado(c.id)"
                  :class="
                    c.estado == 0 ? 'btn-outline-success' : 'btn-outline-danger'
                  "
                >
                  <i
                    v-if="c.estado == 1"
                    onclick="return confirm('¿Desea Desactivar?')"
                    class="bi bi-trash"
                  ></i>

                  <i
                    v-if="c.estado == 0"
                    onclick="return confirm('¿Desea Activar?')"
                    class="bi bi-check2-circle"
                  ></i>
                </button> -->
                <button
                  v-if="c.estado == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(c.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="c.estado == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(c.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
    <crear-editar-cliente ref="CrearEditarCliente" />
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
    CambiarEstado: function (id) {
      let me = this;
      axios
        .post("api/clientes/" + id + "/camEstado", null, me.$root.config)
        .then(function () {
          me.listarClientes(1);
        });
    },
  },
};
</script>
