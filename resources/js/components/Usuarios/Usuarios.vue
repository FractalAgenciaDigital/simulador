<template>
  <div>
    <div class="page-header">
      <h3>Usuarios</h3>
      <hr />
      <button
        @click="
          update = false;
          openModal();
        "
        type="button"
        class="btn btn-primary"
      >
        Crear Usuario
      </button>

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
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Documento</th>
              <th>Celular</th>
              <th>Sede</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="usuario in usuarios" :key="usuario.id">
              <td>{{ usuario.id }}</td>
              <td>{{ usuario.name }}</td>
              <td>{{ usuario.nombre }}</td>
              <td>{{ usuario.email }}</td>
              <td>{{ usuario.documento }}</td>
              <td>{{ usuario.celular }}</td>
              <td>{{ usuario.sede }}</td>
              <td>{{ usuario.rol }}</td>
              <td>{{ usuario.estado }}</td>
              <td class="text-center">
                <button
                  class="btn btn-outline-primary"
                  @click="
                    update = true;
                    openModal(usuario);
                  "
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="usuario.estado == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(usuario.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="usuario.estado == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(usuario.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
                <!-- <button
                  v-if="usuario.estado == 1"
                  onclick="return confirm('¿Desea Eliminar?')"
                  class="btn btn-outline-info"
                  @click="eliminar(usuario.id)"
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
        estado: "",
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
    async list() {
      // axios el poder de JS
      const res = await axios.get("usuarios");

      this.usuarios = res.data;
    },
    // Eliminar
    async eliminar(id) {
      // axios el poder de JS
      const res = await axios.delete("/usuarios/" + id);
      // para que actualicen los arrays o no tener que recargar el navegador
      this.list();
    },
    async save() {
      if (this.update) {
        const res = await axios.put("/usuarios/" + this.id, this.usuario);
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
    openModal(data = {}) {
      this.modal = 1;
      if (this.update) {
        this.id = data.id;
        this.titleModal = "Modificar Usuario";
        // Si vamos a modificar debesmo llenar todos los campos con los datos del registro seleccionado
        this.usuario.name = data.name;
        this.usuario.email = data.email;
        this.usuario.password = data.password;
        this.usuario.nombre = data.nombre;
        this.usuario.celular = data.celular;
        this.usuario.direccion = data.direccion;
        this.usuario.tipo_documento = data.tipo_documento;
        this.usuario.documento = data.documento;
        this.usuario.foto = data.foto;
        this.usuario.estado = data.estado;
        this.usuario.id_rol = data.id_rol;
        this.usuario.id_sede = data.id_sede;
      } else {
        this.id = 0;
        this.titleModal = "Crear Usuario";

        // Para que se muestren vacios
        this.usuario.name = "";
        this.usuario.email = "";
        this.usuario.password = "";
        this.usuario.nombre = "";
        this.usuario.celular = "";
        this.usuario.direccion = "";
        this.usuario.tipo_documento = "";
        this.usuario.documento = "";
        this.usuario.foto = "";
        this.usuario.estado = "";
        this.usuario.id_rol = "";
        this.usuario.id_sede = "";
      }
    },
    closeModal() {
      this.modal = 0;
    },
  },

  created() {
    this.list();
  },
  // CambiarEstado: function (id) {
  //   // let me = this;
  //   const res = await axios
  //     .post("api/usuarios/" + id + "/camEstado", null, me.$root.config)
  //     .then(function () {
  //       me.list(1);
  //     });
  // },
};
</script>

<style>
.show {
  display: list-item;
  opacity: 1;
  background: rgba(63, 80, 69, 0.849);
}
</style>