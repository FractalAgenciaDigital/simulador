<template>
    <div class="">
        <div class="card-body">
            <div>
                <div class="">
                    <button
                        type="submit"
                        class="btn btn-primary col-md-3 offset-9 mb-5"
                        id="btnCalcular"
                        @click="calcularCuota()"
                    >
                        Calcular
                    </button>

                    <table id="lista-tabla" class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cuota</th>
                                <th>Capital</th>
                                <th>Interés</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary rounded"
              @click="editar = crearSimulador()"
            >
                Guardar
            </button>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
  // capital valor total del prestamo
  // tasa valor de tasa de interes que se compraria
  // plazos numero de pagos
  data() {
    return {
      editar: false,
      cuotas: {
        credito_id: "1",
        fecha_pago: "1986-11-18",
        dias_mora: "2",
        valor_interes_mora: "2",
        valor_pago_interes: "",
        valor_pago_capital: "2",
        valor: "",
        nro_cuota: "",
      },
      formCuotas: {},
    };
  },
  methods: {
    crearSimulador() {
      let me = this;
      axios.post("api/cuotas", this.cuotas).then(function () {
        $("#formSimuladorModal").modal("hide");
        me.resetData();
        this.$emit("listar-creditos");
      });
    },
    abrirSimulador(credito) {
      this.editar = true;
      let me = this;
      $("#formSimuladorModal").modal("show");
      me.formSimulador = credito;
    },
    editarSimulador() {
      let me = this;
      axios.put("api/creditos/" + 4, this.cuotas).then(function () {
        $("#formSimuladorModal").modal("hide");
        me.resetData();
      });
      this.$emit("listar-creditos");

      this.editar = false;
    },
    simular: function (id) {
      let me = this;
      axios
        .post("api/creditos/" + id + "/cuotas", null, me.$root.config)
        .then(function () {
          me.listarCreditos(1);
        });
    },
    resetData() {
      let me = this;
      Object.keys(this.cuotas).forEach(function (key, index) {
        me.cuotas[key] = "";
      });
    },
    capturar() {
      function Cuotass(valor, tiempo, valor_pago_interes) {
        this.valor = valor;
        this.valor_pago_interes = valor_pago_interes;
        this.tiempo = tiempo;
      }

      var valorCapturar = document.getElementById("valor").value;
      var tiempoCapturar = document.getElementById("tiempo").value;
      var valor_pago_interesCapturar =
        document.getElementById("valor_pago_interes").value;

      let newCuota = new Cuotass(
        valorCapturar,
        tiempoCapturar,
        valor_pago_interesCapturar
      );

      console.log(newCuota);
    },
    agregar() {
      this.formCuotas.push(newCuota);
      console.log(agregar);
    },

    calcularCuota() {
      let me = this;
      var valor = me.cuotas.valor;
      var valor_pago_interes = me.cuotas.valor_pago_interes;
      var nro_cuota = me.cuotas.nro_cuota;

      // console.log(me.cuotas.valor);
      // console.log(me.cuotas.valor_pago_interes);
      // console.log(me.cuotas.nro_cuota);
      const llenarTabla = document.querySelector("#lista-tabla tbody");

      while (llenarTabla.firstChild) {
        llenarTabla.removeChild(llenarTabla.firstChild);
      }

      let fecha_pago = [];
      let fechaActual = Date.now();
      let mes_actual = moment(fechaActual);
      mes_actual.add(1, "month");

      let pagoInteres = [];
      let pagoCapital = [];
      let cuota = [];

      cuota =
        (valor *
          ((Math.pow(1 + valor_pago_interes / 100, nro_cuota) *
            valor_pago_interes) /
            100)) /
        (Math.pow(1 + valor_pago_interes / 100, nro_cuota) - 1);

      // console.log(cuota);
      for (let i = 1; i <= nro_cuota; i++) {
        pagoInteres = parseFloat(valor * (valor_pago_interes / 100));
        pagoCapital = cuota - pagoInteres;
        valor = parseFloat(valor - pagoCapital);

        console.log(pagoCapital);

        //Formato fecha_pago
        fecha_pago[i] = mes_actual.format("DD-MM-YYYY");
        mes_actual.add(1, "month");

        me.formCuotas.fecha_pago = fecha_pago;
        me.formCuotas.pagoInteres = pagoInteres;
        me.formCuotas.pagoCapital = pagoCapital;
        // me.formCuotas.nro_cuota = i;

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${fecha_pago[i]}</td>
            <td>${cuota.toFixed(2)}</td>
            <td>${pagoCapital.toFixed(2)}</td>
            <td>${pagoInteres.toFixed(2)}</td>
            <td>${valor.toFixed(2)}</td>
        `;
                llenarTabla.appendChild(row);
            }
        }
    },
    computed: {}
};
</script>
