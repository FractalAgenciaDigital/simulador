<template>
  <div>
    <div class="page-header">
      <h3>Creditos</h3>
      <hr />
      <button
        @click="
          update = false;
          openModal();
        "
        type="button"
        class="btn btn-primary"
      >
        Crear Credito
      </button>
      <br />
      <br />

      <div class="modal" :class="{ show: modal }">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                {{ titleModal }}
              </h5>
              <button
                @click="closeModal()"
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-row">
                  <div class="search-box">
                    <label for="id_cliente">Cliente:</label>
                    <input
                      type="text"
                      class="form-control"
                      name=""
                      id=""
                      placeholder="Buscar Cliente"
                    />
                  </div>

                  <!-- <div class="form-group col-md-4">
                    <label for="id_cliente">Cliente</label>
                    <select v-model="credito.nombres">
                      <option
                        v-for="cliente in clientes.data"
                        :key="cliente.id"
                      >
                        {{ cliente.nombres }} {{ cliente.apellidos }}
                      </option>
                    </select>
                  </div> -->

                  <div class="form-group col-md-4">
                    <label for="Apellidos">Apellidos</label>
                    <input
                      type="text"
                      class="form-control"
                      id="Apellidos"
                      v-model="credito.apellidos"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="fecha_nacimiento">Fecha nacimiento</label>
                    <input
                      type="date"
                      class="form-control"
                      id="fecha_nacimiento"
                      v-model="credito.fecha_nacimiento"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="tipo_documento">Tipo Documento</label>
                    <select
                      name="tipo_documento"
                      id="tipo_documento"
                      class="custom-select"
                      v-model="credito.tipo_documento"
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
                      v-model="credito.nro_documento"
                    />
                  </div>

                  <div class="form-group col-md-4">
                    <label for="tipo_documento">Estado civil</label>
                    <select
                      name="estado_civil"
                      id="estado_civil"
                      class="custom-select"
                      v-model="credito.estado_civil"
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
                        v-model="credito.genero"
                      />
                      <label class="form-check-label" for="Hombre"
                        >Hombre</label
                      >
                    </div>
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="inlineRadioOptions"
                        id="Mujer"
                        value="option2"
                        v-model="credito.genero"
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
                        v-model="credito.genero"
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
                      v-model="credito.email"
                    />
                  </div>
                  <div class="form-group col-4">
                    <label for="direccion">Dirección</label>
                    <input
                      type="text"
                      class="form-control"
                      id="direccion"
                      v-model="credito.direccion"
                    />
                  </div>
                  <div class="form-group col-4">
                    <label for="celular1">Celular 1</label>
                    <input
                      type="tel"
                      class="form-control"
                      id="celular1"
                      v-model="credito.celular1"
                    />
                  </div>
                  <div class="form-group col-4">
                    <label for="celular2">Celular 2</label>
                    <input
                      type="tel"
                      class="form-control"
                      id="celular2"
                      v-model="credito.celular2"
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
                      v-model="credito.lugar_trabajo"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="cargo">Cargo</label>
                    <input
                      type="text"
                      class="form-control"
                      id="cargo"
                      v-model="credito.cargo"
                    />
                  </div>
                  <div class="form-check col-md-4 ml-4">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      value="1"
                      id="independiente"
                      v-model="credito.independiente"
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
                @click="closeModal()"
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                aria-label="Close"
              >
                Cerrar
              </button>
              <button @click="save()" type="button" class="btn btn-success">
                Guardar Cambios
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- ------------Modal----------------------- -->
    </div>
    <div class="page-content">
      <section>
        <table
          class="
            table
            table-sm
            table-bordered
            table-responsive
            table-striped
            table-hover
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
              <th>Créditos</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="credito in creditos" :key="credito.id">
              <td>{{ credito.id }}</td>
              <td>{{ credito.credito }}</td>
              <td v-if="credito.estado_credito == 1">Activo</td>
              <td v-if="credito.estado_credito == 0">Inactivo</td>
              <td>{{ credito.direccion }}</td>
              <td>{{ credito.nit }}</td>
              <td>{{ credito.correo_contacto }}</td>
              <td>{{ credito.representante }}</td>
              <td>{{ credito.celular_contacto }}</td>
              <td class="text-center">
                <button
                  v-if="credito.estado_credito == 1"
                  class="btn btn-outline-primary"
                  @click="
                    update = true;
                    openModal(credito);
                  "
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="credito.estado_credito == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(credito.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="credito.estado_credito == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(credito.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
                <!-- <button
                  v-if="credito.estado_credito == 1"
                  onclick="return confirm('¿Desea Eliminar?')"
                  class="btn btn-outline-info"
                  @click="eliminar(credito.id)"
                >
                  <i class="bi bi-trash"></i>
                </button> -->
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";

export default {
  components: {
    Multiselect,
  },

  data() {
    return {
      // Este array lo enlazamos con v-model en los campos del modal
      credito: {
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

      // Cuando abrimos el modal lo que hacemos es cargar el id
      id: 0,
      update: true,
      // modal abiarto = 1 y cerrado=0
      modal: 0,
      titleModal: "",
      // Aqui vamos a guardar todos los registros para recorrerlos
      // En plural contiene todos los registros que se han agragado a la BD
      creditos: [],
    };
  },
  methods: {
    async list() {
      // axios el poder de JS
      const res = await axios.get("creditos");

      this.creditos = res.data;
    },
    // Eliminar
    async eliminar(id) {
      // axios el poder de JS
      const res = await axios.delete("/creditos/" + id);
      // para que actualicen los arrays o no tener que recargar el navegador
      this.list();
    },
    async save() {
      if (this.update) {
        const res = await axios.put(
          "/creditos/" + this.credito.id,
          this.credito
        );
        //Para guardar nuevo registro
      } else {
        const res = await axios.post("/creditos/", this.credito);
      }
      this.closeModal();
      this.list();
    },
    // abrir y cerrar modal
    // Si no se pasa ningun parametro será 0
    // Ahora no solo tenemos que pasar el id si no todo el array completo
    openModal(data) {
      this.modal = 1;
      if (data) {
        // if (this.credito.id != "undefined") {
        // this.id = data.id;
        this.credito = data;
        // this.id = data.id;
        this.titleModal = "Modificar Credito";
      } else {
        this.titleModal = "Crear Credito";
      }
    },
    closeModal() {
      this.modal = 0;
      let me = this;
      Object.keys(this.credito).forEach(function (key, index) {
        me.credito[key] = "";
      });
    },
    CambiarEstado: function (id) {
      let me = this;
      axios.post("api/creditos/" + id + "/camEstado").then(function () {
        me.list(1);
      });
    },
  },

  created() {
    this.list();
  },
};
</script>

<style>
.show {
  display: list-item;
  opacity: 1;
  background: rgba(63, 80, 69, 0.849);
}
</style>