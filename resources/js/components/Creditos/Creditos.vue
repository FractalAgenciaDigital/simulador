<template>
  <div class="">
    <div class="page-header d-flex justify-content-between p-4 border my-2">
      <h3>Creditos</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#formCreditoModal"
      >
        Crear Credito
      </button>
    </div>
    <div class="page-search d-flex justify-content-between p-4 border my-2">
      <div class="form-group col-8 m-auto">
        <label for="buscar_credito">Buscar...</label>
        <input
          type="text"
          id="buscar_credito"
          name="buscar_credito"
          class="form-control"
          placeholder="Nombres | Documento"
          @keypress="listarCreditos()"
          v-model="buscar_credito"
        />
      </div>
    </div>

    <div v-if="buscar_credito.length > 0" class="page-content mt-4">
      <section class="">
        <table class="table table-sm table-bordered table-responsive">
          <thead>
            <tr>
              <th>ID</th>
              <th>Cliente</th>
              <th>Valor crédito</th>
              <th>Valor Abonado</th>
              <th>Nro Cuotas</th>
              <th>Cuotas</th>
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

              <td v-if="credito.id_rol == 1">Administrador</td>
              <td v-if="credito.id_rol == 2">Operario</td>
              <td v-if="credito.estado == 1">Activo</td>
              <td v-if="credito.estado == 0">Inactivo</td>

              <td class="text-center">
                <button
                  v-if="credito.estado == 1"
                  class="btn btn-outline-primary"
                  @click="mostrarDatos(credito)"
                >
                  <i class="bi bi-pen"></i>
                </button>
                <button
                  v-if="credito.estado == 1"
                  class="btn btn-outline-danger"
                  @click="CambiarEstado(credito.id)"
                >
                  <i class="bi bi-trash"></i>
                </button>
                <button
                  v-if="credito.estado == 0"
                  class="btn btn-outline-success"
                  @click="CambiarEstado(credito.id)"
                >
                  <i class="bi bi-check2-circle"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          :align="'center'"
          :data="listaCreditos"
          :limit="8"
          @pagination-change-page="listarCreditos"
        >
          <span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span>
        </pagination>
      </section>
    </div>

    <div v-else>
      <div class="alert alert-danger">
        No hay coincidencias para esta busqueda.
      </div>
      <div class="alert alert-info">
        Crear un nuevo Cliente
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#formClienteModal"
        >
          Crear cliente
        </button>
      </div>
    </div>

    <crear-editar-cliente
      ref="CrearEditarCliente"
      @listar-clientes="listarCreditos(1)"
    />
    <crear-editar-credito
      ref="CrearEditarCredito"
      @listar-creditos="listarCreditos(1)"
    />
  </div>
</template>
<script>
import CrearEditarCredito from "./CrearEditarCredito.vue";
import CrearEditarCliente from "./../Clientes/CrearEditarCliente.vue";

export default {
  components: { CrearEditarCredito, CrearEditarCliente },
  data() {
    return {
      buscar_credito: "",
      listaCreditos: {},
    };
  },
  created() {
    this.listarCreditos(1);
  },
  methods: {
    listarCreditos(page = 1) {
      let me = this;
      axios
        .get(`api/creditos?page=${page}&credito=${this.buscar_credito}`)
        .then(function (response) {
          me.listaCreditos = response.data;
        });
    },
    mostrarDatos: function (credito) {
      this.$refs.CrearEditarCredito.abirEditarCredito(credito);
    },
    mostrarDatosCliente: function (cliente) {
      this.$refs.CrearEditarCliente.abirEditarCliente(cliente);
    },
    CambiarEstado: function (id) {
      let me = this;

      Swal.fire({
        title: "¿Quieres cambiar el estado del credito?",
        showDenyButton: true,
        denyButtonText: `Cancelar`,
        confirmButtonText: `Guardar`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(
              "api/creditos/" + id + "/cambiar-estado",
              null,
              me.$root.config
            )
            .then(function () {
              me.listarCreditos(1);
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
