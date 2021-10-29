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
    <div class="page-search d-flex justify-content-between p-4 border my-2">
      <div class="form-group col-8 m-auto">
        <label for="buscar_cliente">Buscar...</label>
        <input
          type="text"
          id="buscar_cliente"
          name="buscar_cliente"
          class="form-control"
          placeholder="Nombres | Documento"
          @keypress="listarClientes(1)"
          v-model="buscar_cliente"
        />
      </div>
    </div>
    <div class="page-content mt-4">
      <section class="">
        <table
          class="
            table
            table-sm
            table-bordered
            table-responsive
            table-hover
            table-striped
          "
        >
          <thead>
            <tr>
              <th>id</th>
              <th>Nombres</th>
              <th>Documento</th>
              <th>Celular</th>
              <th>Correo Electronico</th>
              <th>Dirección</th>
              <th>Estado</th>
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
              <td>
                <button
                  class="btn"
                  :class="
                    c.estado == 1 ? 'btn-outline-success' : 'btn-outline-danger'
                  "
                  @click="CambiarEstado(c.id)"
                >
                  <i class="bi bi-check-circle-fill" v-if="c.estado == 1"></i>
                  <i class="bi bi-x-circle" v-if="c.estado == 0"></i>
                </button>
              </td>
              <td v-if="c.estado == 1" class="text-center">
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
    <crear-editar-cliente
      ref="CrearEditarCliente"
      @listar-clientes="listarClientes(1)"
    />
  </div>
</template>
<script>
import CrearEditarCliente from "./CrearEditarCliente.vue";
export default {
  components: { CrearEditarCliente },
  data() {
    return {
      buscar_cliente: "",
      listaClientes: {},
    };
  },
  created() {
    this.listarClientes(1);
  },
  methods: {
    listarClientes(page = 1) {
      let me = this;
      axios
        .get(`api/clientes?page=${page}&cliente=${this.buscar_cliente}`)
        .then(function (response) {
          me.listaClientes = response.data;
        });
    },
    mostrarDatos: function (cliente) {
      this.$refs.CrearEditarCliente.abirEditarCliente(cliente);
    },
    CambiarEstado: function (id) {
      let me = this;

      Swal.fire({
        title: "¿Quieres cambiar el estado del cliente?",
        showDenyButton: true,
        denyButtonText: `Cancelar`,
        confirmButtonText: `Guardar`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(`api/clientes/${id}/cambiar-estado`, null, me.$root.config)
            .then(function () {
              me.listarClientes(1);
            });
          Swal.fire("Cambios realizados!", "", "success");
        } else if (result.isDenied) {
          Swal.fire("Operación no realizada", "", "info");
        }
      });
    },
  },
};
</script>
