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
                <!-- <div class="form-group col-md-4">
                  <label for="buscar_cliente">Buscar Cliente</label>
                  <input
                    type="text"
                    id="buscar_cliente"
                    name="buscar_cliente"
                    class="form-control"
                    placeholder="Nombre | Apellido | Documento"
                    @keypress="listarCreditos(1)"
                    v-model="buscar_cliente"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="buscar_sede">Buscar Sede</label>
                  <input
                    type="text"
                    id="buscar_sede"
                    name="buscar_sede"
                    class="form-control"
                    placeholder="Sede"
                    @keypress="listarCreditos(1)"
                    v-model="buscar_sede"
                  />
                </div> -->

                <div class="form-group col-md-4">
                  <label for="cant_cuotas">Cantidad Cuotas</label>
                  <input
                    type="text"
                    class="form-control"
                    id="cant_cuotas"
                    v-model="formCredito.cant_cuotas"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="cant_cuotas_pagadas"
                    >Cantidad Cuotas Pagadas</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="cant_cuotas_pagadas"
                    v-model="formCredito.cant_cuotas_pagadas"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="dia_limite">Dia Limite</label>
                  <input
                    type="text"
                    class="form-control"
                    id="dia_limite"
                    v-model="formCredito.dia_limite"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="deudor">Deudor</label>
                  <input
                    type="text"
                    class="form-control"
                    id="deudor"
                    v-model="formCredito.deudor"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="fecha_inicio">Fecha Inicial</label>
                  <input
                    type="date"
                    class="form-control"
                    id="fecha_inicio"
                    v-model="formCredito.fecha_inicio"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="interes_mensual">Interes Mensual</label>
                  <input
                    type="text"
                    class="form-control"
                    id="interes_mensual"
                    v-model="formCredito.interes_mensual"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="porcent_interes_anual"
                    >Porcentaje Interes Anual</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="porcent_interes_anual"
                    v-model="formCredito.porcent_interes_anual"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="porcent_interes_mensual"
                    >Porcentaje Interes Mensual</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="porcent_interes_mensual"
                    v-model="formCredito.porcent_interes_mensual"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="valor_cuota">Valor Cuota</label>
                  <input
                    type="text"
                    class="form-control"
                    id="valor_cuota"
                    v-model="formCredito.valor_cuota"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="valor_credito">Valor Credito</label>
                  <input
                    type="text"
                    class="form-control"
                    id="valor_credito"
                    v-model="formCredito.valor_credito"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="valor_abonado">Valor Abonado</label>
                  <input
                    type="text"
                    class="form-control"
                    id="valor_abonado"
                    v-model="formCredito.valor_abonado"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="valor_capital">Valor Capital</label>
                  <input
                    type="text"
                    class="form-control"
                    id="valor_capital"
                    v-model="formCredito.valor_capital"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="valor_interes">Valor Interes</label>
                  <input
                    type="text"
                    class="form-control"
                    id="valor_interes"
                    v-model="formCredito.valor_interes"
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