<template>
  <div>
    <section>
      <table class="table">
        <thead>
          <tr>
            <th>id</th>
            <th>Nombres</th>
            <th>Documento</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="c in listaClientes.data" :key="c.id">
            <td>{{ c.id }}</td>
            <td>{{ c.nombres }} {{ c.apellidos }}</td>
            <td>{{ c.nro_documento }}</td>
          </tr>
        </tbody>
      </table>
    </section>
  </div>
</template>
<script>
export default {
  data() {
    return {
      listaClientes: {},
    };
  },
  created() {
    this.listarClientes(1);
  },
  methods: {
    listarClientes(page = 1) {
      let me = this;
      axios.get("api/clientes?page=" + page).then(function (response) {
        me.listaClientes = response.data;
      });
    },
  },
};
</script>