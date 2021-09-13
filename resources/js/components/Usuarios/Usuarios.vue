<template>
  <div class="">
    <div class="page-header d-flex justify-content-between p-4 border my-2">
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
    <div class="page-search d-flex justify-content-between p-4 border my-2">
      <div class="form-group col-8 m-auto">
        <label for="buscar_usuario">Buscar...</label>
        <input
          type="text"
          id="buscar_usuario"
          name="buscar_usuario"
          class="form-control"
          placeholder="Nombres | Documento"
          @keypress="listarUsuarios(1)"
          v-model="buscar_usuario"
        />
      </div>
    </div>
    <div class="page-content mt-4">
      <section class="">
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
              <td>{{ u.id_sede }}</td>
              <td v-if="u.id_rol == 1">Administrador</td>
              <td v-if="u.id_rol == 2">Operario</td>
              <td v-if="u.estado == 1">Activo</td>
              <td v-if="u.estado == 0">Inactivo</td>

              <td class="text-center">
                <button
                  v-if="u.estado == 1"
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
                  class="btn btn-outline-success"
                  @click="CambiarEstado(u.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :align="'center'"
          :data="listaUsuarios"
          :limit="8"
          @pagination-change-page="listarUsuarios"
        >
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
      </section>
    </div>
    <crear-editar-usuario
      ref="CrearEditarUsuario"
      @listar-usuarios="listarUsuarios(1)"
    />
  </div>
</template>
<script>
import CrearEditarUsuario from "./CrearEditarUsuario.vue";
export default {
  components: { CrearEditarUsuario },
  data() {
    return {
      buscar_usuario: "",
      listaUsuarios: {},
    };
  },
  created() {
    this.listarUsuarios(1);
  },
  methods: {
    listarUsuarios(page = 1) {
      let me = this;
      axios
        .get(`api/usuarios?page=${page}&usuario=${this.buscar_usuario}`)
        .then(function (response) {
          me.listaUsuarios = response.data;
        });
    },
    mostrarDatos: function (usuario) {
      this.$refs.CrearEditarUsuario.abirEditarUsuario(usuario);
    },
    CambiarEstado: function (id) {
      let me = this;

      Swal.fire({
        title: "¿Quieres cambiar el estado del usuario?",
        showDenyButton: true,
        denyButtonText: `Cancelar`,
        confirmButtonText: `Guardar`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(
              "api/usuarios/" + id + "/cambiar-estado",
              null,
              me.$root.config
            )
            .then(function () {
              me.listarUsuarios(1);
            });
          Swal.fire("Cambios realizados!", "", "success");
        } else if (result.isDenied) {
          Swal.fire("Operación no realizada", "", "info");
        }
      });
    },
  },
};
</script>
