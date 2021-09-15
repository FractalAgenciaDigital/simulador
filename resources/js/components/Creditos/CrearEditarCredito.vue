<template>
  <div>
    <div
      class="modal fade"
      id="formCreditoModal"
      tabindex="-1"
      aria-labelledby="formCreditoModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formCreditoModalLabel">Creditos</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="(editar = false), resetData()"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="name">Credito</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="formCredito.name"
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
              @click="(editar = false), resetData()"
            >
              Cerrar
            </button>
            <button
              type="button"
              class="btn btn-primary rounded"
              @click="editar ? editarCredito() : crearCredito()"
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
      formCredito: {
        id_cliente: "",
        id_deudor: "",
        id_sede: "",
        cant_cuotas: "",
        cant_cuotas_pagadas: "",
        cant_cuotas_pagadas: "",
        dia_limite: "",
        deudor: "",
        estado: "1",
        fecha_inicio: "",
        interes_mensual: "",
        porcent_interes_anual: "",
        porcent_interes_mensual: "",
        usu_crea: "",
        calor_cuota: "",
        valor_credito: "",
        valor_abonado: "",
        valor_capital: "",
        valor_interes: "",
      },
    };
  },
  // Function crearCreditos
  methods: {
    crearCredito() {
      let me = this;
      axios.post("api/creditos", this.formCredito).then(function () {
        $("#formCreditoModal").modal("hide");
        me.resetData();
        this.$emit("listar-creditos");
      });
    },
    abirEditarCredito(credito) {
      this.editar = true;
      let me = this;
      $("#formCreditoModal").modal("show");
      me.formCredito = credito;
    },
    editarCredito() {
      let me = this;
      axios
        .put("api/creditos/" + this.formCredito.id, this.formCredito)
        .then(function () {
          $("#formCreditoModal").modal("hide");
          me.resetData();
        });
      this.$emit("listar-creditos");

      this.editar = false;
    },
    resetData() {
      let me = this;
      Object.keys(this.formCredito).forEach(function (key, index) {
        me.formCredito[key] = "";
      });
    },
  },
};
</script>