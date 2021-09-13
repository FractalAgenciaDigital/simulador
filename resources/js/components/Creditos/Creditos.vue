<template>
  <div>
    <div class="page-header">
      <h3>Creditos</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#formCreditoModal"
      >
        Crear Credito
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
            table-hover
            table-striped
          "
        >
          <thead>
            <tr>
              <th>id</th>
              <th>Cliente</th>
              <th>Deudor</th>
              <th>Sede</th>
              <th>Cant. Cuotas</th>
              <th>Cant. Cuotas Pagadas</th>
              <th>Simular</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="credito in listaCreditos.data" :key="credito.id">
              <td>{{ credito.id }}</td>
              <td>{{ credito.id_cliente }}</td>
              <td>{{ credito.id_deudor }}</td>
              <td>{{ credito.id_sede }}</td>
              <td>{{ credito.cant_cuotas }}</td>
              <td>{{ credito.cant_cuotas_pagadas }}</td>
              <td>
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <router-link to="/simulador"> Simular Crédito </router-link>
                  </li>
                </ul>
              </td>
              <td v-if="credito.estado == 1">Activo</td>
              <td v-if="credito.estado == 0">Inactivo</td>

              <td class="text-center">
                <button
                  v-if="credito.estado == 1"
                  class="btn btn-outline-primary"
                  @click="
                    update = true;
                    openModal(credito);
                  "
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="credito.estado == 1"
                  onclick="return confirm('¿Desea Desactivar?')"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(credito.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="credito.estado == 0"
                  onclick="return confirm('¿Desea Activar?')"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(credito.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
                <!-- <button
                  v-if="credito.estado == 1"
                  onclick="return confirm('¿Desea Eliminar?')"
                  class="btn btn-outline-info"
                  @click="eliminar(credito.id)"
                >
                  <i class="bi bi-trash"></i>
                </button> -->
              </td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
    <crear-editar-credito ref="CrearEditarCredito" />
  </div>
</template>

<script>
import CrearEditarCredito from "./CrearEditarCredito.vue";
import datables from "datatables";

export default {
  components: { CrearEditarCredito },
  mounted() {
    this.listarCreditos();
  },
  data() {
    return {
      listaCreditos: {},
    };
  },
  created() {
    this.listarCreditos(1);
  },
  methods: {
    listarCreditos(page = 1) {
      let me = this;
      axios.get("api/creditos?page=" + page).then(function (response) {
        me.listaCreditos = response.data;
      });
    },
    myTable() {
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    },
    mostrarDatos: function (credito) {
      this.$refs.CrearEditarCredito.abirEditarCredito(credito);
    },
    search() {
      axios.post("api/creditos/buscar?q=");
    },
    CambiarEstado: function (id) {
      let me = this;
      axios
        .post("api/creditos/" + id + "/camEstado", null, me.$root.config)
        .then(function () {
          me.listarCreditos(1);
        });
    },
  },
};
</script>
