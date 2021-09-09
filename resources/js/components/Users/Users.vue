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
      <br />
      <br />

      <!-- ----START Modal--------- -->
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
                      v-model="user.name"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="nombre">Nombre</label>
                    <input
                      type="text"
                      class="form-control"
                      id="nombre"
                      v-model="user.nombre"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input
                      type="text"
                      class="form-control"
                      id="email"
                      v-model="user.email"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="celular">Celular</label>
                    <input
                      type="number"
                      class="form-control"
                      id="celular"
                      v-model="user.celular"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="tipo_documento">Tipo Documento</label>
                    <select
                      name="tipo_documento"
                      id="tipo_documento"
                      class="custom-select"
                      v-model="user.tipo_documento"
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
                      v-model="user.documento"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="id_sede">Sede</label>

                    <input
                      type="number"
                      class="form-control"
                      id="id_sede"
                      v-model="user.id_sede"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="id_rol">Rol</label>
                    <select
                      name="id_rol"
                      id="id_rol"
                      class="custom-select"
                      v-model="user.id_rol"
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
                      v-model="user.password"
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
          id="myTable"
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
            <tr v-for="user in users" :key="user.id">
              <td>{{ user.id }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.nombre }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.documento }}</td>
              <td>{{ user.celular }}</td>
              <td>{{ user.id_sede }}</td>
              <td v-if="user.id_rol == 1">Administrador</td>
              <td v-if="user.id_rol == 2">Operario</td>
              <td v-if="user.estado == 1">Activo</td>
              <td v-if="user.estado == 0">Inactivo</td>
              <td class="text-center">
                <button
                  class="btn btn-outline-primary"
                  @click="
                    update = true;
                    openModal(user);
                  "
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="user.estado == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(user.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="user.estado == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(user.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
                <button
                  v-if="user.estado == 1"
                  onclick="return confirm('¿Desea Eliminar?')"
                  class="btn btn-outline-info"
                  @click="eliminar(user.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
    <crear-editar-user ref="CrearEditarUser" />
  </div>
</template>
<script>
import CrearEditarUser from "./CrearEditarUser.vue";
import datables from "datatables";

export default {
  mounted() {
    this.getDatos();
  },
  data() {
    return {
      // Este array lo enlazamos con v-model en los campos del modal
      user: {
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
      users: [],
    };
  },
  methods: {
    getDatos() {
      var urlDatos = "users";
      axios.get(urlDatos).then((response) => {
        this.users = response.data;
        this.myTable();
      });
    },
    myTable() {
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    },
    // async list() {
    //   // axios el poder de JS
    //   const res = await axios.get("users");

    //   this.users = res.data;
    // },
    // Eliminar
    async eliminar(id) {
      // axios el poder de JS
      const res = await axios.delete("/users/" + id);
      // para que actualicen los arrays o no tener que recargar el navegador
      // this.list();
      this.getDatos();
    },
    async save() {
      if (this.update) {
        const res = await axios.put("/users/" + this.user.id, this.user);
        //Para guardar nuevo registro
      } else {
        const res = await axios.post("/users/", this.user);
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
        // if (this.user.id != "undefined") {
        // this.id = data.id;
        this.user = data;
        // this.id = data.id;
        this.titleModal = "Modificar Usuario";
      } else {
        this.titleModal = "Crear Usuario";
      }
    },
    closeModal() {
      this.modal = 0;
      // let me = this;
      Object.keys(this.user).forEach(function (key, index) {
        me.user[key] = "";
      });
    },
    CambiarEstado: function (id) {
      let me = this;
      axios.post("api/users/" + id + "/camEstado").then(function () {
        // me.list(1);
        me.getDatos();
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