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
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="p in listaProveedores.data" :key="p.id">
              <td>{{ p.id }}</td>
              <td>{{ p.nombres }}</td>
              <td>{{ p.apellidos }}</td>
              <td v-if="p.tipo_documento == '1' ">Cèdula de ciudadania</td>
              <td v-if="p.tipo_documento == '2' ">Passaporte</td>
              <td>{{ p.nro_documento }}</td>
              <td>{{ p.celular1 }}</td>
              <td>{{ p.celular2 }} </td>
              <td>{{ p.email }}</td>
              <td>{{ p.direccion }}</td>
              <td class="text-center">
                <button class="btn btn-outline-primary" @click="mostrarDatos(p)">
                  <i class="bi bi-pen"></i>
                </button>
                <button class="btn btn-outline-danger">
                  <i class="bi bi-trash"></i>
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
    showAlert() {

      this.$swal("Proveedores");
    },

  },
};
</script>
