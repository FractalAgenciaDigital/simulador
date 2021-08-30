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
            <h5 class="modal-title" id="formCreditoModalLabel">
              Gestionar Credito
            </h5>
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
                  <label for="id_cliente">Clienmte</label>
                  <select v-model="formCredito.nombres">
                    <option
                      v-for="cliente in listaCreditos.data"
                      :key="cliente.id"
                    >
                      {{ cliente.nombres }} {{ cliente.apellidos }}
                    </option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="Apellidos">Apellidos</label>
                  <input
                    type="text"
                    class="form-control"
                    id="Apellidos"
                    v-model="formCredito.apellidos"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="fecha_nacimiento">Fecha nacimiento</label>
                  <input
                    type="date"
                    class="form-control"
                    id="fecha_nacimiento"
                    v-model="formCredito.fecha_nacimiento"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="tipo_documento">Tipo Documento</label>
                  <select
                    name="tipo_documento"
                    id="tipo_documento"
                    class="custom-select"
                    v-model="formCredito.tipo_documento"
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
                    v-model="formCredito.nro_documento"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="tipo_documento">Estado civil</label>
                  <select
                    name="estado_civil"
                    id="estado_civil"
                    class="custom-select"
                    v-model="formCredito.estado_civil"
                  >
                    <option value="0" disabled>--Seleccionar--</option>
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Union libre">Union libre</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Viudo">Viudo</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="genero">Género</label>
                  <br />
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="inlineRadioOptions"
                      id="Hombre"
                      value="option1"
                      v-model="formCredito.genero"
                    />
                    <label class="form-check-label" for="Hombre">Hombre</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="inlineRadioOptions"
                      id="Mujer"
                      value="option2"
                      v-model="formCredito.genero"
                    />
                    <label class="form-check-label" for="Mujer">Mujer</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="inlineRadioOptions"
                      id="Otro"
                      value="option3"
                      v-model="formCredito.genero"
                    />
                    <label class="form-check-label" for="Otro">Otro</label>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-4">
                  <label for="email">Correo Electronico</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="formCredito.email"
                  />
                </div>
                <div class="form-group col-4">
                  <label for="direccion">Dirección</label>
                  <input
                    type="text"
                    class="form-control"
                    id="direccion"
                    v-model="formCredito.direccion"
                  />
                </div>
                <div class="form-group col-4">
                  <label for="celular1">Celular 1</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="celular1"
                    v-model="formCredito.celular1"
                  />
                </div>
                <div class="form-group col-4">
                  <label for="celular2">Celular 2</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="celular2"
                    v-model="formCredito.celular2"
                  />
                </div>
                <!-- </div>
              <div class="form-row"> -->
                <div class="form-group col-md-4">
                  <label for="lugar_trabajo">Lugar de trabajo</label>
                  <input
                    type="email"
                    class="form-control"
                    id="lugar_trabajo"
                    v-model="formCredito.lugar_trabajo"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="cargo">Cargo</label>
                  <input
                    type="text"
                    class="form-control"
                    id="cargo"
                    v-model="formCredito.cargo"
                  />
                </div>
                <div class="form-check col-md-4 ml-4">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value="1"
                    id="independiente"
                    v-model="formCredito.independiente"
                  />
                  <label class="form-check-label" for="independiente">
                    Independiente
                  </label>
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
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
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
        nombres: "",
        apellidos: "",
        tipo_documento: 0,
        nro_documento: 0,
        fecha_nacimiento: "",
        email: "",
        celular1: "",
        celular2: "",
        genero: "",
        number: "",
        estado_civil: "",
        independiente: 0,
        lugar_trabjo: "",
        cargo: "",
      },
    };
  },
  // Function crearCreditos
  methods: {
    crearCredito() {
      let me = this;
      axios.post("api/creditos", this.formCredito).then(function () {
        $("#formCreditoModal").modal("hide");
        me.formCredito = {};
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
          me.formCredito = {};
        });
      this.editar = false;
    },
  },
};
</script>