<template>
    <div class="">
        <div class="card-body">
            <div>
                <div class="">
                    <button
                        type="submit"
                        class="btn btn-primary col-md-3 offset-9 mb-5"
                        id="btnCalcular"
                        @click="simularCuotas()"
                    >
                        Calcular
                    </button>

                    <table id="lista-tabla" class="table">
                        <thead>
                            <tr>
                                <th>Nro.Cuota</th>
                                <th>Fecha</th>
                                <th>Cuota</th>
                                <th>Capital</th>
                                <th>Interés</th>
                                <th>Saldo Capital</th>
                            </tr>
                        </thead>
                        <tbody v-if="listadoCuotas.length">
                            <tr
                                v-for="cuota in listadoCuotas"
                                :key="cuota.nro_cuota"
                            >
                                <td>
                                    No. {{ cuota.nro_cuota }}
                                </td>
                                <td>
                                   $ {{ cuota.fecha_pago }}
                                </td>
                                <td>{{ cuota.valor_cuota }}</td>
                                <td>
                                   $ {{ cuota.pagoCapital }}
                                </td>
                                <td>
                                    ${{ cuota.pagoInteres }}
                                </td>
                                <td>
                                    $ {{ cuota.saldo_capital }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button
                type="button"
                class="btn btn-primary rounded"
                @click="editar = crearSimulador()"
            >
                Guardar
            </button> -->
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: ["nro_cuotas", "interes", "capital"],
    // capital valor total del prestamo
    // tasa valor de tasa de interes que se compraria
    // plazos numero de pagos
    data() {
        return {
            editar: false,
            listadoCuotas: [],
            formCuotas: {},
            valor_cuota: 0
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
        resetData() {
            let me = this;
            Object.keys(this.cuotas).forEach(function(key, index) {
                me.cuotas[key] = "";
            });
        },
        agregar() {
            this.formCuotas.push(newCuota);
            console.log(agregar);
        },
        simularCuotas() {
            let me = this;
            axios
                .get(
                    `api/cuotas/calcular-cuotas?valor_credito=${this.capital}&interes=${this.interes}&nro_cuotas=${this.nro_cuotas}`
                )
                .then(
                    response => (
                        (me.listadoCuotas = response.data.listadoCuotas),
                        (me.valor_cuota = response.data.cuota)
                        
                    )
                );
        }
    },
    mounted() {
        // this.simularCuotas();
    }
};
</script>
