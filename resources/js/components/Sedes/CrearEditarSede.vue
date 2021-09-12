<template>
  <div>
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
                <div class="form-group col-md-4">
                  <label for="sede">Sede</label>
                  <input
                    type="text"
                    class="form-control"
                    id="sede"
                    v-model="sede.sede"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="estado_sede">Estado</label>
                  <select
                    name="estado_sede"
                    id="estado_sede"
                    class="custom-select"
                    v-model="sede.estado_sede"
                  >
                    <option value="" disabled>--Seleccionar--</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="direccion">Dirección</label>
                  <input
                    type="text"
                    class="form-control"
                    id="direccion"
                    v-model="sede.direccion"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="nit">NIT</label>
                  <input
                    type="number"
                    class="form-control"
                    id="nit"
                    v-model="sede.nit"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="correo_contacto">Correo Contacto</label>
                  <input
                    type="email"
                    class="form-control"
                    id="correo_contacto"
                    v-model="sede.correo_contacto"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="representante">Representante</label>

                  <input
                    type="text"
                    class="form-control"
                    id="representante"
                    v-model="sede.representante"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label for="celular_contacto">Celular Contacto</label>

                  <input
                    type="number"
                    class="form-control"
                    id="celular_contacto"
                    v-model="sede.celular_contacto"
                  />
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
</template>
<script>
export default {
  // mounted() {
  //   this.getDatos();
  // },
  data() {
    return {
      // Este array lo enlazamos con v-model en los campos del modal
      sede: {
        sede: "",
        estado_sede: "1",
        direccion: "",
        nit: "",
        correo_contacto: "",
        representante: "",
        celular_contacto: "",
      },

      // Cuando abrimos el modal lo que hacemos es cargar el id
      id: 0,
      update: true,
      // modal abiarto = 1 y cerrado=0
      modal: 0,
      titleModal: "",
      // Aqui vamos a guardar todos los registros para recorrerlos
      // En plural contiene todos los registros que se han agragado a la BD
      sedes: [],
    };
  },
  methods: {
    getDatos() {
      var urlDatos = "sedes";
      axios.get(urlDatos).then((response) => {
        this.sedes = response.data;
        this.myTable();
      });
    },
    myTable() {
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    },
    async save() {
      if (this.update) {
        const res = await axios.put("/sedes/" + this.sede.id, this.sede);
        //Para guardar nuevo registro
      } else {
        const res = await axios.post("/sedes/", this.sede);
      }
      this.closeModal();
      // this.list();
      this.getDatos();
    },

    // abrir y cerrar modal
    // Si no se pasa ningun parametro será 0
    // Ahora no solo tenemos que pasar el id si no todo el array completo
    openModal(data) {
      this.modal = 1;
      if (data) {
        // if (this.sede.id != "undefined") {
        // this.id = data.id;
        this.sede = data;
        // this.id = data.id;
        this.titleModal = "Modificar Sede";
      } else {
        this.titleModal = "Crear Sede";
      }
    },
    closeModal() {
      this.modal = 0;
      // let me = this;
      Object.keys(this.sede).forEach(function (key, index) {
        me.sede[key] = "";
      });
    },
  },

  created() {
    // this.list();
    this.getDatos();
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