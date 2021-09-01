<template>
  <div class="">
    <div class="page-header d-flex justify-content-between p-4 border my-2">
      <h3>Proveedores</h3>
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
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="c in listaProveedores.data" :key="c.id">
              <td>{{ c.id }}</td>
              <td>{{ c.nombres }}</td>
              <td>{{ c.apellidos }}</td>
              <td>{{ c.nro_documento }}</td>
              <td>{{ c.celular1 }}</td>
              <td>{{ c.celular2 }}</td>
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
                <button
                  v-if="c.activo == 1"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(c.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="c.activo == 0"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(c.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :align="'center'"
          :data="listaProveedores"
          :limit="8"
          @pagination-change-page="listarProveedores"
        >
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
      </section>
    </div>
    <crear-editar-proveedor
      ref="CrearEditarProveedor"
      @listar-proveedor="listarProveedor(1)"
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
    showAlert() {
      // Use sweetalert2
      this.$swal("Hello Vue world!!!");
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
              "api/proveedores/" + id + "/cambiar-estado",
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
