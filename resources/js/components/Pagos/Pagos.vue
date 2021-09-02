<template>
  <div class="">
    <div class="page-header">
      <h3>Pagos</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#formPagosModal"
      >
        Crear pago
      </button>
    </div>
    <div class="page-content mt-4">
      <section class="">
        <table class="table table-sm table-bordered table-responsive">
          <thead>
            <tr>
              <th>id</th>
              <th>Tipo Deuda</th>
              <th>Id Deuda</th>
              <th>Valor Pago</th>
              <th>Nro Cuota</th>
              <th>Valor Interes</th>
              <th>Valor Capital</th>
              <th>Id Tercero</th>
              <th>Fecha Pago</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="c in listaPagos.data" :key="c.id">
              <td>{{}}</td>
              <td>{{}}</td>
              <td>{{}}</td>
              <td>{{}}</td>
              <td>{{}}</td>
              <td>{{}}</td>
              <td>{{}}</td>
              <td>{{}}</td>
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
          :data="listaPagos"
          :limit="8"
          @pagination-change-page="listarPagos"
        >
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
      </section>
    </div>
    <crear-editar-pago
      ref="CrearEditarPago"
      @listar-pago="listarPago(1)"
    />
  </div>
</template>
<script>
import CrearEditarPago from "./CrearEditarPago.vue";
export default {
  components: { CrearEditarPago },
  data() {
    return {
      listaPagos: {},
    };
  },
  created() {
    this.listarPagos(1);
  },
  methods: {
    listarPagos(page = 1) {
      let me = this;
      axios.get("api/pagos?page=" + page).then(function (response) {
        me.listaPagos = response.data;
      });
    },
    mostrarDatos: function (pago) {
      this.$refs.CrearEditarPago.abirEditarPago(pago);
    },
    showAlert() {
      // Use sweetalert2
      this.$swal("Hello Vue world!!!");
    },
    CambiarEstado: function (id) {
      let me = this;

      Swal.fire({
        title: "¿Quieres cambiar el estado del pago?",
        showDenyButton: true,
        denyButtonText: `Cancelar`,
        confirmButtonText: `Guardar`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(
              "api/pagos/" + id + "/cambiar-estado",
              null,
              me.$root.config
            )
            .then(function () {
              me.listarPagos(1);
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
