<template>
    <div id="vue-simulador">
        <div
            class="modal fade"
            id="formSimuladorModal"
            tabindex="-1"
            aria-labelledby="formSimuladorModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formSimuladorModalLabel">
                            Simulador
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            @click="(editar = false), resetData()"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- --------------------------- -->
                        <div id="app">
                            <div class="row">
                                <div class="col-4">
                                    <h2>
                                        Calcular amortización método francés
                                    </h2>
                                    <div class="form-group">
                                        <label for="monto">Monto</label>
                                        <input
                                            required
                                            type="number"
                                            class="form-control"
                                            id="monto"
                                            v-model="cuotas.monto"
                                            placeholder="Ingresar monto"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="tiempo"
                                            >Tiempo en Meses</label
                                        >
                                        <input
                                            required
                                            type="number"
                                            class="form-control"
                                            id="tiempo"
                                            v-model="cuotas.tiempo"
                                            placeholder="Ingresar cantidad de meses"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="interes"
                                            >Interés Mensual</label
                                        >
                                        <input
                                            required
                                            type="number"
                                            class="form-control"
                                            id="interes"
                                            v-model="cuotas.interes"
                                            placeholder="Ingresar tasa de interés mensual"
                                        />
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        id="btnCalcular"
                                        @click="calcularCuota()"
                                    >
                                        Calcular
                                    </button>
                                </div>
                                <div class="col-8">
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
                        <!-- --------------------------- -->
                        <!-- <simulador
                :tasa="16.0"
                :capital="1257.23"
                :plazos="9"
                ref="Simulador"
                @simular-credito="simularCredito(1)"
              /> -->
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            @click="(editar = false), resetData()"
                        >
                            Cerrar
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary rounded"
                            @click="editar = editarSimulador()"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="./_simulador.js"></script> -->
</template>

<script>
import moment from "moment";
export default {
    // capital monto total del prestamo
    // tasa valor de tasa de interes que se compraria
    // plazos numero de pagos
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
        abrirSimulador(credito) {
            this.editar = true;
            let me = this;
            $("#formSimuladorModal").modal("show");
            me.formSimulador = credito;
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
            var monto = me.cuotas.monto;
            var interes = me.cuotas.interes;
            var tiempo = me.cuotas.tiempo;
            
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
