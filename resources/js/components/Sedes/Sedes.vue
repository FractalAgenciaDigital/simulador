<template>
  <div>
    <div class="page-header">
      <h3>Sedes</h3>
      <hr />
      <button
        @click="
          update = false;
          openModal();
        "
        type="button"
        class="btn btn-primary"
      >
        Crear Sede
      </button>
      <br />
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
              <th>Sede</th>
              <th>Estado Sede</th>
              <th>Dirección</th>
              <th>NIT</th>
              <th>Correo Contacto</th>
              <th>Representante</th>
              <th>Celular Contacto</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sede in sedes" :key="sede.id">
              <td>{{ sede.id }}</td>
              <td>{{ sede.sede }}</td>
              <td v-if="sede.estado == 1">Activo</td>
              <td v-if="sede.estado == 0">Inactivo</td>
              <td>{{ sede.direccion }}</td>
              <td>{{ sede.nit }}</td>
              <td>{{ sede.correo_contacto }}</td>
              <td>{{ sede.representante }}</td>
              <td>{{ sede.celular_contacto }}</td>
              <td class="text-center">
                <button
                  v-if="sede.estado == 1"
                  class="btn btn-outline-primary"
                  @click="
                    update = true;
                    openModal(sede);
                  "
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="sede.estado == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(sede.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="sede.estado == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(sede.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
                <!-- <button
                  v-if="sede.estado == 1"
                  onclick="return confirm('¿Desea Eliminar?')"
                  class="btn btn-outline-info"
                  @click="eliminar(sede.id)"
                >
                  <i class="bi bi-trash"></i>
                </button> -->
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
    <crear-editar-sede ref="CrearEditarSede" />
  </div>
</template>
<script>
import CrearEditarSede from "./CrearEditarSede.vue";
import datables from "datatables";

export default {
  components: { CrearEditarSede },
  mounted() {
    this.getDatos();
  },
  data() {
    return {
      // Este array lo enlazamos con v-model en los campos del modal
      sede: {
        sede: "",
        estado: "1",
        direccion: "",
        nit: "",
        correo_contacto: "",
        representante: "",
        celular_contacto: "",
      },

      // Cuando abrimos el modal lo que hacemos es cargar el id
      id: 0,
      update: true,
      // modal abiarto = 1 y cerrado=0
      modal: 0,
      titleModal: "",
      // Aqui vamos a guardar todos los registros para recorrerlos
      // En plural contiene todos los registros que se han agragado a la BD
      sedes: [],
    };
  },
  methods: {
    getDatos() {
      var urlDatos = "sedes";
      axios.get(urlDatos).then((response) => {
        this.sedes = response.data;
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
    //   const res = await axios.get("sedes");

    //   this.sedes = res.data;
    // },

    // async save() {
    //   if (this.update) {
    //     const res = await axios.put("/sedes/" + this.sede.id, this.sede);
    //     //Para guardar nuevo registro
    //   } else {
    //     const res = await axios.post("/sedes/", this.sede);
    //   }
    //   this.closeModal();
    //   // this.list();
    //   this.getDatos();
    // },

    // abrir y cerrar modal
    // Si no se pasa ningun parametro será 0
    // Ahora no solo tenemos que pasar el id si no todo el array completo
    openModal(data) {
      this.modal = 1;
      if (data) {
        // if (this.sede.id != "undefined") {
        // this.id = data.id;
        this.sede = data;
        // this.id = data.id;
        this.titleModal = "Modificar Sede";
      } else {
        this.titleModal = "Crear Sede";
      }
    },
    CambiarEstado: function (id) {
      let me = this;
      axios.post("api/sedes/" + id + "/camEstado").then(function () {
        // me.list(1);
        me.getDatos();
      });
    },
    closeModal() {
      this.modal = 0;
      // let me = this;
      Object.keys(this.sede).forEach(function (key, index) {
        me.sede[key] = "";
      });
    },
    async eliminar(id) {
      // axios el poder de JS
      const res = await axios.delete("/sedes/" + id);
      // para que actualicen los arrays o no tener que recargar el navegador
      // this.list();
      this.getDatos();
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