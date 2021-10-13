<template>
  <div class="">
    <div class="page-header">
      <h3>proveedores</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#formProveedorModal"
      >
        Crear proveedor
      </button>
    </div>
    <div class="page-content mt-4">
      <section class="">
        <table class="table table-sm table-bordered table-responsive">
          <thead>
            <tr>
              <th>id</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Tipo Documento</th>
              <th>Num Documento</th>
              <th>Celular1</th>
              <th>Celular2</th>
              <th>Correo Electronico</th>
              <th>Dirección</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="p in listaProveedores.data" :key="p.id">
              <td>{{ p.id }}</td>
              <td>{{ p.nombres }}</td>
              <td>{{ p.apellidos }}</td>
              <td>
                <span v-if="p.tipo_documento == '1'">Cèdula de ciudadania</span>
                <span v-if="p.tipo_documento == '2'">Passaporte</span>
              </td>
              <td>{{ p.nro_documento }}</td>
              <td>{{ p.celular1 }}</td>
              <td>{{ p.celular2 }}</td>
              <td>{{ p.email }}</td>
              <td>{{ p.direccion }}</td>
              <td>
                <button
                  class="btn"
                  :class="
                    p.estado == 1 ? 'btn-outline-success' : 'btn-outline-danger'
                  "
                  @click="CambiarEstado(p.id)"
                >
                  <i class="bi bi-check-circle-fill" v-if="p.estado == 1"></i>
                  <i class="bi bi-x-circle" v-if="p.estado == 0"></i>
                </button>
              </td>
              <td class="text-center">
                <button
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(p)"
                >
                  <i class="bi bi-pen"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :align="'center'"
          :data="listaProveedores"
          :limit="10"
          @pagination-change-page="listarProveedores"
        >
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
      </section>
    </div>
    <crear-editar-proveedor
      ref="CrearEditarProveedor"
      @listar-proveedores="listarProveedores(1)"
    />
  </div>
</template>
<script>
import CrearEditarProveedor from "./CrearEditarProveedor.vue";
export default {
  components: { CrearEditarProveedor },
  data() {
    return {
      listaProveedores: {},
    };
  },
  created() {
    this.listarProveedores(1);
  },
  methods: {
    listarProveedores(page = 1) {
      let me = this;
      axios.get("api/proveedores?page=" + page).then(function (response) {
        me.listaProveedores = response.data;
      });
    },
    mostrarDatos: function (proveedor) {
      this.$refs.CrearEditarProveedor.abirEditarProveedor(proveedor);
    },
    CambiarEstado: function (id) {
      let me = this;

      Swal.fire({
        title: "¿Quieres cambiar el estado del proveedor?",
        showDenyButton: true,
        denyButtonText: `Cancelar`,
        confirmButtonText: `Guardar`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(
              `api/proveedores/${id}/cambiar-estado`,
              null,
              me.$root.config
            )
            .then(function () {
              me.listarProveedores(1);
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
