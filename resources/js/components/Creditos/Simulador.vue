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
                @click="editar = editarSimulador()"
            >
                Guardar
            </button>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: ["interes", "nro_cuotas", "capital"],
    data() {
        return {
            editar: false,
            cuotas: {
                monto: "",
                tiempo: "",
                interes: ""
            },
            formCuotas: {}
        };
    },
    methods: {
        crearSimulador() {
            let me = this;
            axios.post("api/cuotas", this.cuotas).then(function() {
                $("#formSimuladorModal").modal("hide");
                me.resetData();
                this.$emit("listar-creditos");
            });
        },
        abrirSimulador() {
            this.editar = true;
            let me = this;
            $("#formSimuladorModal").modal("show");
        },
        editarSimulador() {
            let me = this;
            axios.put("api/creditos/" + 4, this.cuotas).then(function() {
                $("#formSimuladorModal").modal("hide");
                me.resetData();
            });
            this.$emit("listar-creditos");

            this.editar = false;
        },
        simular: function(id) {
            let me = this;
            axios
                .post("api/creditos/" + id + "/cuotas", null, me.$root.config)
                .then(function() {
                    me.listarCreditos(1);
                });
        },
        Calcular: function() {
            function humanizeNumber(n) {
                n = n.toString();
                while (true) {
                    var n2 = n.replace(/(\d)(\d{3})($|,|\.)/g, "$1,$2$3");
                    if (n == n2) break;
                    n = n2;
                }
                return n;
            }

            const formatter = new Intl.NumberFormat("es", {
                style: "currency",
                currency: "COL",
                minimumFractionDigits: 2
            });
        },

        resetData() {
            let me = this;
            Object.keys(this.cuotas).forEach(function(key, index) {
                me.cuotas[key] = "";
            });
        },

        calcularCuota() {
            let me = this;
            var monto = me.capital;
            var interes = me.interes;
            var tiempo = me.nro_cuotas;

            const llenarTabla = document.querySelector("#lista-tabla tbody");

            while (llenarTabla.firstChild) {
                llenarTabla.removeChild(llenarTabla.firstChild);
            }

            let fechas = [];
            let fechaActual = Date.now();
            let mes_actual = moment(fechaActual);
            mes_actual.add(1, "month");

            let pagoInteres = 0,
                pagoCapital = 0,
                cuota = 0;

            cuota =
                (monto *
                    ((Math.pow(1 + interes / 100, tiempo) * interes) / 100)) /
                (Math.pow(1 + interes / 100, tiempo) - 1);

            console.log(cuota);
            for (let i = 1; i <= tiempo; i++) {
                pagoInteres = parseFloat(monto * (interes / 100));
                pagoCapital = cuota - pagoInteres;
                monto = parseFloat(monto - pagoCapital);

                //Formato fechas
                fechas[i] = mes_actual.format("DD-MM-YYYY");
                mes_actual.add(1, "month");

                me.formCuotas.fechas = fechas;
                me.formCuotas.pagoInteres = pagoInteres;
                me.formCuotas.pagoCapital = pagoCapital;
                me.formCuotas.nro_cuota = i + 1;

                const row = document.createElement("tr");
                row.innerHTML = `
            <td>${fechas[i]}</td>
            <td>${cuota.toFixed(2)}</td>
            <td>${pagoCapital.toFixed(2)}</td>
            <td>${pagoInteres.toFixed(2)}</td>
            <td>${monto.toFixed(2)}</td>
        `;
                llenarTabla.appendChild(row);
            }
        }
    },
    computed: {}
};
</script>
