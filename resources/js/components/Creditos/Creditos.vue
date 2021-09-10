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
              <th>ID</th>
              <th>Cliente</th>
              <th>Valor crédito</th>
              <th>Valor Abonado</th>
              <th>Nro Cuotas</th>
              <th>día limite</th>
              <th>Estado</th>
              <th>Cuotas</th>
              <th>Editar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="c in listaCreditos.data" :key="c.id">
              <td>{{ c.id }}</td>
              <td>{{ c.cliente.nombres }} {{ c.cliente.apellidos }}</td>
              <td>{{ c.valor_credito }}</td>
              <td>{{ c.valor_abonado }}</td>
              <td>{{ c.cant_cuotas }}</td>
              <td>{{ c.dia_limite }}</td>
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
    <crear-editar-credito ref="CrearEditarCredito" />
  </div>
</template>

<script>
import CrearEditarCredito from "./CrearEditarCredito.vue";
export default {
  components: { CrearEditarCredito },
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
