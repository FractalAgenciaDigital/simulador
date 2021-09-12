<template>
  <div>
    <div class="page-header">
      <h3>Sedes</h3>
      <hr />
      <button
        @click="
          update = false;
          openModal();
        "
        type="button"
        class="btn btn-primary"
      >
        Crear Sede
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
              <th>Sede</th>
              <th>Estado Sede</th>
              <th>Dirección</th>
              <th>NIT</th>
              <th>Correo Contacto</th>
              <th>Representante</th>
              <th>Celular Contacto</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sede in sedes" :key="sede.id">
              <td>{{ sede.id }}</td>
              <td>{{ sede.sede }}</td>
              <td v-if="sede.estado_sede == 1">Activo</td>
              <td v-if="sede.estado_sede == 0">Inactivo</td>
              <td>{{ sede.direccion }}</td>
              <td>{{ sede.nit }}</td>
              <td>{{ sede.correo_contacto }}</td>
              <td>{{ sede.representante }}</td>
              <td>{{ sede.celular_contacto }}</td>
              <td class="text-center">
                <button
                  v-if="sede.estado_sede == 1"
                  class="btn btn-outline-primary"
                  @click="
                    update = true;
                    openModal(sede);
                  "
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="sede.estado_sede == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(sede.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="sede.estado_sede == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(sede.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
                <!-- <button
                  v-if="sede.estado_sede == 1"
                  onclick="return confirm('¿Desea Eliminar?')"
                  class="btn btn-outline-info"
                  @click="eliminar(sede.id)"
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
export default {
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
    async list() {
      // axios el poder de JS
      const res = await axios.get("sedes");

      this.sedes = res.data;
    },
    // Eliminar
    async eliminar(id) {
      // axios el poder de JS
      const res = await axios.delete("/sedes/" + id);
      // para que actualicen los arrays o no tener que recargar el navegador
      this.list();
    },
    async save() {
      if (this.update) {
        const res = await axios.put("/sedes/" + this.sede.id, this.sede);
        //Para guardar nuevo registro
      } else {
        const res = await axios.post("/sedes/", this.sede);
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
    CambiarEstado: function (id) {
      let me = this;
      axios.post("api/sedes/" + id + "/camEstado").then(function () {
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