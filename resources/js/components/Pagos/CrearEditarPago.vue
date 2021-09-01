<template>
  <div>
    <div
      class="modal fade"
      id="formPagoModal"
      tabindex="-1"
      aria-labelledby="formPagoModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formPagoModalLabel">Modal pagos</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="editar = false"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              //
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="editar = false"
            >
              Cerrar
            </button>
            <button
              type="button"
              class="btn btn-primary rounded"
              @click="editar ? editarPago() : crearPago()"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editar: false,
      formPago: {
        //
      },
    };
  },
  // Function crearPagos
  methods: {
    crearPago() {
      let me = this;
      axios.post("api/pagos", this.formPago).then(function () {
        $("#formPagoModal").modal("hide");
        me.formPago = {};
        this.$emit("listar-pagos");
      });
    },
    abirEditarPago(pago) {
      this.editar = true;
      let me = this;
      $("#formPagoModal").modal("show");
      me.formPago = pago;
    },
    editarPago() {
      let me = this;
      axios
        .put("api/pago/" + this.formPago.id, this.formPago)
        .then(function () {
          $("#formPagoModal").modal("hide");
          me.formPago = {};
        });
      this.$emit("listar-pagos");

      this.editar = false;
    },
  },
};
</script>