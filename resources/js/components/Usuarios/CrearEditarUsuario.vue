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
            <h5 class="modal-title" id="formUsuarioModalLabel">Usuarios</h5>
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
                  <label for="name">Usuario</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="formUsuario.name"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="nombre">Nombre</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    v-model="formUsuario.nombre"
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
                    type="number"
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
                  <label for="id_sede">Sede</label>

                  <input
                    type="number"
                    class="form-control"
                    id="id_sede"
                    v-model="formUsuario.id_sede"
                  />
                </div>
                <div class="form-group col-md-4">
                  <label for="id_rol">Rol</label>
                  <select
                    name="id_rol"
                    id="id_rol"
                    class="custom-select"
                    v-model="formUsuario.id_rol"
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
              @click="(editar = false), resetData()"
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
        id_rol: "",
        id_sede: "",
      },
    };
  },
  // Function crearUsuarios
  methods: {
    crearUsuario() {
      let me = this;
      axios.post("api/usuarios", this.formUsuario).then(function () {
        $("#formUsuarioModal").modal("hide");
        me.resetData();
        this.$emit("listar-usuarios");
      });
    },
    abirEditarUsuario(usuario) {
      this.editar = true;
      let me = this;
      $("#formUsuarioModal").modal("show");
      me.formUsuario = usuario;
    },
    editarUsuario() {
      let me = this;
      axios
        .put("api/usuarios/" + this.formUsuario.id, this.formUsuario)
        .then(function () {
          $("#formUsuarioModal").modal("hide");
          me.resetData();
        });
      this.$emit("listar-usuarios");

      this.editar = false;
    },
    resetData() {
      let me = this;
      Object.keys(this.formUsuario).forEach(function (key, index) {
        me.formUsuario[key] = "";
      });
    },
  },
};
</script>