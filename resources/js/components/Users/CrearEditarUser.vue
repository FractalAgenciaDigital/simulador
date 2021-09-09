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
                  <label for="name">Usuario</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="usuario.name"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="nombre">Nombre</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    v-model="usuario.nombre"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    v-model="usuario.email"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="celular">Celular</label>
                  <input
                    type="number"
                    class="form-control"
                    id="celular"
                    v-model="usuario.celular"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="tipo_documento">Tipo Documento</label>
                  <select
                    name="tipo_documento"
                    id="tipo_documento"
                    class="custom-select"
                    v-model="usuario.tipo_documento"
                  >
                    <option value="0" disabled>--Seleccionar--</option>
                    <option value="1">Cédula de ciudadanía</option>
                    <option value="2">Pasaporte</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="documento">Nro. Documento</label>

                  <input
                    type="number"
                    class="form-control"
                    id="documento"
                    v-model="usuario.documento"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="id_sede">Sede</label>

                  <input
                    type="number"
                    class="form-control"
                    id="id_sede"
                    v-model="usuario.id_sede"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="id_rol">Rol</label>
                  <select
                    name="id_rol"
                    id="id_rol"
                    class="custom-select"
                    v-model="usuario.id_rol"
                  >
                    <option value="0" disabled>--Seleccionar--</option>
                    <option value="1">Administrador</option>
                    <option value="2">Operario</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="password">Contraseña</label>
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    v-model="usuario.password"
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
  data() {
    return {
      // Este array lo enlazamos con v-model en los campos del modal
      usuario: {
        name: "",
        email: "",
        password: "",
        nombre: "",
        celular: "",
        direccion: "",
        tipo_documento: 0,
        documento: 0,
        foto: "",
        estado: "1",
        id_rol: "",
        id_sede: "",
      },

      // Cuando abrimos el modal lo que hacemos es cargar el id
      id: 0,
      update: true,
      // modal abiarto = 1 y cerrado=0
      modal: 0,
      titleModal: "",
      // Aqui vamos a guardar todos los registros para recorrerlos
      // En plural contiene todos los registros que se han agragado a la BD
      usuarios: [],
    };
  },
  methods: {
    async save() {
      if (this.update) {
        const res = await axios.put(
          "/usuarios/" + this.usuario.id,
          this.usuario
        );
        //Para guardar nuevo registro
      } else {
        const res = await axios.post("/usuarios/", this.usuario);
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
        // if (this.usuario.id != "undefined") {
        // this.id = data.id;
        this.usuario = data;
        // this.id = data.id;
        this.titleModal = "Modificar Usuario";
      } else {
        this.titleModal = "Crear Usuario";
      }
    },
    closeModal() {
      this.modal = 0;
      // let me = this;
      Object.keys(this.usuario).forEach(function (key, index) {
        me.usuario[key] = "";
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