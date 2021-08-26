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
            <tr v-for="c in listaUsuarios.data" :key="c.id">
              <td>{{ c.id }}</td>
              <td>{{ c.name }}</td>
              <td>{{ c.nombre }}</td>
              <td>{{ c.email }}</td>
              <td>{{ c.documento }}</td>
              <td>{{ c.sede }}</td>
              <td>{{ c.rol }}</td>
              <td>{{ c.estado }}</td>
              <td class="text-center">
                <button class="btn btn-outline-primary">
                  <i class="bi bi-eye"></i>
                </button>
              </td>
              <td class="text-center">
                <button class="btn btn-outline-primary">
                  <i class="bi bi-pen"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
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
    created() {
        this.listarUsuarios(1);
    },
    methods: {
        listarUsuarios(page = 1) {
            let me = this;
            axios.get("api/usuarios?page=" + page).then(function(response) {
                me.listaUsuarios = response.data;
            });
        }
    }
}
}
</script>
