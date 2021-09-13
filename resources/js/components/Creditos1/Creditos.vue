<template>
  <div>
    <div class="page-header d-flex justify-content-between p-4 border my-2">
      <h3>Creditos</h3>
      <button class="btn btn-primary" type="button">Crear Credito</button>
    </div>
    <div class="page-content mt-4">
      <section>
        <table class="table table-sm table-responsive-sm table-bordered">
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
              <td>{{ c.cliente.nombres }} {{ c.cliente.apellidos }}</td>
              <td>{{ credito.id_deudor }}</td>
              <td>{{ credito.id_sede }}</td>
              <td>{{ credito.cant_cuotas }}</td>
              <td>{{ credito.cant_cuotas_pagadas }}</td>

              <td>{{ c.estado == 1 ? "Activo" : "Inactivo" }}</td>
              <td>
                <router-link
                  :to="{ name: 'cuotas', params: { credito_id: c.id } }"
                  class="btn btn-outline-primary"
                >
                  <i class="bi bi-eye"></i>
                </router-link>
              </td>
              <td>
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
export default {
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
      axios.get(`api/creditos?page=${page}`).then(function (response) {
        me.listaCreditos = response.data;
      });
    },
  },
};
</script>