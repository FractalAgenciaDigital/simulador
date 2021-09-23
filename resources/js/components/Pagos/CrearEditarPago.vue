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
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="tipo_deuda">TipoDeuda</label>
                  <input
                    type="text"
                    class="form-control"
                    id="tipo_deuda"
                    v-model="formPago.tipo_deuda"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="Apellidos">Apellidos</label>
                  <input
                    type="text"
                    class="form-control"
                    id="Apellidos"
                    v-model="formProveedor.apellidos"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="tipo_documento">Tipo Documento</label>
                  <select
                    name="tipo_documento"
                    id="tipo_documento"
                    class="custom-select"
                    v-model="formProveedor.tipo_documento"
                  >
                    <option value="0" disabled>--Seleccionar--</option>
                    <option value="1">Cédula de ciudadanía</option>
                    <option value="2">Passaporte</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="Apellidos">Nro. Documento</label>

                  <input
                    type="number"
                    class="form-control"
                    id="Documento"
                    v-model="formProveedor.nro_documento"
                  />
                </div>

                <div class="form-group col-4">
                  <label for="celular1">Celular 1</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="celular1"
                    v-model="formProveedor.celular1"
                  />
                </div>
                <div class="form-group col-4">
                  <label for="celular2">Celular 2</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="celular2"
                    v-model="formProveedor.celular2"
                  />
                </div>

                <div class="form-group col-4">
                  <label for="email">Correo Electronico</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="formProveedor.email"
                  />
                </div>
                <div class="form-group col-4">
                  <label for="direccion">Dirección</label>
                  <input
                    type="text"
                    class="form-control"
                    id="direccion"
                    v-model="formProveedor.direccion"
                  />
                </div>
              </div>
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
        .put("api/pagos/" + this.formPago.id, this.formPago)
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