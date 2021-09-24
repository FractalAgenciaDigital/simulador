<template>
  <div>
    <div class="page-header"></div>
    <div class="page-content">
      <section>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th>Fecha de vencimiento</th>
              <th scope="col">Nro. Cuota</th>
              <th scope="col">Valor</th>
              <th scope="col">Capital</th>
              <th>Interés</th>
              <th>Mora</th>
              <th>Dias de mora</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(c, index) in listadoCuotas" :key="c.id">
              <th scope="row">{{ index + 1 }}</th>
              <th>{{ c.fecha_pago }}</th>
              <td>{{ c.nro_cuota }}</td>
              <td>{{ c.valor }}</td>
              <td>{{ c.valor_pago_capital }}</td>
              <td>{{ c.valor_pago_interes }}</td>
              <td>{{ c.valor_interes_mora }}</td>
              <td>{{ c.dias_mora }}</td>
              <td>
                <button class="btn btn-success">Pagar</button>
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
  props: ["credito_id"],
  data() {
    return {
      listadoCuotas: [],
    };
  },
  created() {
    this.listarCuotasCredito();
  },
  methods: {
    listarCuotasCredito() {
      let me = this;
      axios
        .get(`api/creditos/${this.credito_id}/cuotas`)
        .then(function (response) {
          me.listadoCuotas = response.data;
        });
    },
    abrirCuotas(credito) {
      this.editar = true;
      let me = this;
      $("#formCuotasModal").modal("show");
      me.formCuotas = credito;
    },
  },
};
</script>

<style>
</style>