<template>
  <div class="">
    <div class="page-header d-flex justify-content-between p-4 border my-2">
      <h3>Sedes</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#formSedeModal"
      >
        Crear Sede
      </button>
    </div>
    <div class="page-search d-flex justify-content-between p-4 border my-2">
      <div class="form-group col-8 m-auto">
        <label for="buscar_sede">Buscar...</label>
        <input
          type="text"
          id="buscar_sede"
          name="buscar_sede"
          class="form-control"
          placeholder="Nombres | Documento"
          @keypress="listarSedes(1)"
          v-model="buscar_sede"
        />
      </div>
    </div>
    <div class="page-content mt-4">
      <section class="">
        <table class="table table-sm table-bordered table-responsive">
          <thead>
            <tr>
              <th>id</th>
              <th>Sede</th>
              <th>NIT</th>
              <th>Correo Contacto</th>
              <th>Representante</th>
              <th>Celular Contacto</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sede in listaSedes.data" :key="sede.id">
              <td>{{ sede.id }}</td>
              <td>{{ sede.sede }}</td>
              <td>{{ sede.nit }}</td>
              <td>{{ sede.correo_contacto }}</td>
              <td>{{ sede.representante }}</td>
              <td>{{ sede.celular_contacto }}</td>
              <td>
                <button
                  v-if="sede.estado == 1"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(sede.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="sede.estado == 0"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(sede.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
              </td>

              <td class="text-center">
                <button
                  v-if="sede.estado == 1"
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(sede)"
                >
                  <i class="bi bi-pen"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :align="'center'"
          :data="listaSedes"
          :limit="8"
          @pagination-change-page="listarSedes"
        >
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
      </section>
    </div>
    <crear-editar-sede ref="CrearEditarSede" @listar-sedes="listarSedes(1)" />
  </div>
</template>
<script>
import CrearEditarSede from "./CrearEditarSede.vue";
export default {
  components: { CrearEditarSede },
  data() {
    return {
      buscar_sede: "",
      listaSedes: {},
    };
  },
  created() {
    this.listarSedes(1);
  },
  methods: {
    listarSedes(page = 1) {
      let me = this;
      axios
        .get(`api/sedes?page=${page}&sede=${this.buscar_sede}`)
        .then(function (response) {
          me.listaSedes = response.data;
        });
    },
    mostrarDatos: function (sede) {
      this.$refs.CrearEditarSede.abirEditarSede(sede);
    },
    CambiarEstado: function (id) {
      let me = this;

      Swal.fire({
        title: "¿Quieres cambiar el estado del sede?",
        showDenyButton: true,
        denyButtonText: `Cancelar`,
        confirmButtonText: `Guardar`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(`api/sedes/${id}/cambiar-estado`, null, me.$root.config)
            .then(function () {
              me.listarSedes(1);
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
