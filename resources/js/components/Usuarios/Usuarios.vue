<template>
  <div>
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
              <th>Nombre</th>
              <th>Apellidos</th>
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
              <td>{{ usuario.nombres }}</td>
              <td>{{ usuario.apellidos }}</td>
              <td>{{ usuario.email }}</td>
              <td>{{ usuario.documento }}</td>
              <td>{{ usuario.celular }}</td>
              <td>{{ usuario.sede_id }}</td>
              <td v-if="usuario.rol_id == 1">Administrador</td>
              <td v-if="usuario.rol_id == 2">Operario</td>
              <td v-if="usuario.estado == 1">Activo</td>
              <td v-if="usuario.estado == 0">Inactivo</td>

              <td class="text-right">
                <button
                  v-if="usuario.estado == 1"
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(usuario)"
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="usuario.estado == 1"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(usuario.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="usuario.estado == 0"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(usuario.id)"
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
          <span slot="prev-nav"><i class="bi bi-chevron-double-left"></i></span>
          <span slot="next-nav"
            ><i class="bi bi-chevron-double-right"></i
          ></span>
        </pagination>
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
    mostrarDatos: function (ususario) {
      this.$refs.CrearEditarUsuario.abirEditarUsuario(ususario);
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
