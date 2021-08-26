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
            <h5 class="modal-title" id="formUsuarioModalLabel">Modal title</h5>
            <button
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
                    type="date"
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
                    v-model="formUsuario.tipo_documento">
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
                <div class="form-group col-4">
                  <label for="id_sede">Sede</label>
                  <input
                    type="id_sede"
                    class="form-control"
                    id="id_sede"
                    v-model="formUsuario.id_sede"
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
            >
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="crearUsuario">
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
      },
    };
  },
  // Function crearUsuarios
  methods: {
    crearUsuario() {
      let me = this;
      axios.post("api/usuarios", this.formUsuario).then(function () {
        $("#formUsuarioModal").modal("hide");
        // me.formClient = {};
      });
    },
  },
};
</script>