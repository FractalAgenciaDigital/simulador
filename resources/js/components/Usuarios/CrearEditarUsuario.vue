<template>
  <div>
    <div
      class="modal fade"
      id="formUsuarioModal"
      tabindex="-1"
      aria-labelledby="formUsuarioModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formUsuarioModalLabel">
              Gestionar Usuario
            </h5>
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
                  <label for="nombre">Nombre</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    v-model="formUsuario.nombres"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Apellidos</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="formUsuario.apellidos"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    v-model="formUsuario.email"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="celular">Celular</label>
                  <input
                    type="date"
                    class="form-control"
                    id="celular"
                    v-model="formUsuario.celular"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="tipo_documento">Tipo Documento</label>
                  <select
                    name="tipo_documento"
                    id="tipo_documento"
                    class="custom-select"
                    v-model="formUsuario.tipo_documento"
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
                    v-model="formUsuario.documento"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="sede_id">Sede</label>
                  <v-select
                    :options="listaSedes.data"
                    label="sede"
                    :reduce="(sede) => sede.id"
                    v-model="formUsuario.sede_id"
                  >
                  </v-select>

                  <!-- <input
                    type="number"
                    class="form-control"
                    id="sede_id"
                    v-model="formUsuario.sede_id"
                  /> -->
                </div>
                <div class="form-group col-md-4">
                  <label for="rol_id">Rol</label>
                  <select
                    name="rol_id"
                    id="rol_id"
                    class="custom-select"
                    v-model="formUsuario.rol_id"
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
                    v-model="formUsuario.password"
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
              @click="editar ? editarUsuario() : crearUsuario()"
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
      listaSedes: [],
      formUsuario: {
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
        rol_id: "",
        sede_id: "",
      },
    };
  },
  // Function crearUsuarios
  created() {
    this.listarSedes(1);
  },
  methods: {
    crearUsuario() {
      let me = this;
      axios.post("api/usuarios", this.formUsuario).then(function () {
        $("#formUsuarioModal").modal("hide");
        me.$emit("listar-usuarios");
      });
    },
    abirEditarUsuario(cliente) {
      this.editar = true;
      let me = this;
      $("#formUsuarioModal").modal("show");
      me.formUsuario = cliente;
    },
    editarUsuario() {
      let me = this;
      axios
        .put("api/usuarios/" + this.formUsuario.id, this.formUsuario)
        .then(function () {
          $("#formUsuarioModal").modal("hide");
          me.$emit("listar-usuarios");
        });
      this.editar = false;
    },
    resetData() {
      let me = this;
      Object.keys(this.formUsuario).forEach(function (key, index) {
        me.formUsuario[key] = "";
      });
    },

    listarSedes(page = 1) {
      let me = this;
      axios.get(`api/sedes?page=${page}`).then(function (response) {
        me.listaSedes = response.data;
      });
    },
  },
};
</script>