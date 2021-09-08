<template>
  <div>
    <div class="page-header">
      <h3>Usuarios</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#formUsuarioModal"
      >
        Crear Usuario
      </button>
    </div>
    <div class="page-content">
      <section>
        <table
          class="
            table
            table-sm
            table-bordered
            table-responsive
            table-hover
            table-striped
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
            <tr v-for="usuario in listaUsuarios.data" :key="usuario.id">
              <td>{{ usuario.id }}</td>
              <td>{{ usuario.name }}</td>
              <td>{{ usuario.nombre }}</td>
              <td>{{ usuario.email }}</td>
              <td>{{ usuario.documento }}</td>
              <td>{{ usuario.celular }}</td>
              <td>{{ usuario.id_sede }}</td>
              <td v-if="usuario.id_rol == 1">Administrador</td>
              <td v-if="usuario.id_rol == 2">Operario</td>
              <td v-if="usuario.estado == 1">Activo</td>
              <td v-if="usuario.estado == 0">Inactivo</td>

              <td class="text-center">
                <button
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(usuario)"
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
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
    <crear-editar-usuario ref="CrearEditarUsuario" />
  </div>
</template>

<script>
import CrearEditarUsuario from "./CrearEditarUsuario.vue";
export default {
  components: { CrearEditarUsuario },
  data() {
    return {
      listaUsuarios: {},
    };
  },
  created() {
    this.listarUsuarios(1);
  },
  methods: {
    listarUsuarios(page = 1) {
      let me = this;
      axios.get("api/usuarios?page=" + page).then(function (response) {
        me.listaUsuarios = response.data;
      });
    },
    mostrarDatos: function (ususario) {
      this.$refs.CrearEditarUsuario.abirEditarUsuario(ususario);
    },
    CambiarEstado: function (id) {
      let me = this;
      axios
        .post("api/usuarios/" + id + "/camEstado", null, me.$root.config)
        .then(function () {
          me.listarUsuarios(1);
        });
    },
  },
};
</script>
