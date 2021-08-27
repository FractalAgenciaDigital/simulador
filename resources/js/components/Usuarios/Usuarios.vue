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
        <table class="table table-sm table-bordered table-responsive">
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
            <tr v-for="u in listaUsuarios.data" :key="u.id">
              <td>{{ u.id }}</td>
              <td>{{ u.name }}</td>
              <td>{{ u.nombre }}</td>
              <td>{{ u.email }}</td>
              <td>{{ u.documento }}</td>
              <td>{{ u.celular }}</td>
              <td>{{ u.sede }}</td>
              <td>{{ u.rol }}</td>
              <td>{{ u.estado }}</td>
              <td class="text-center">
                <button
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(u)"
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="u.estado == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(u.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="u.estado == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(u.id)"
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
    mostrarDatos: function (usuario) {
      this.$refs.CrearEditarUsuario.abirEditarUsuario(usuario);
    },

    destroy: function (usuario) {
      this.destroy(usuario);
    },

    DesactivarUsuario: function (id) {
      let me = this;
      axios.delete("api/clientes/" + id).then(function () {
        me.listarUsuarios(1);
      });
    },
  },
};
</script>
