<template>
    <div>
        <div
            class="modal fade"
            id="formCreditoModal"
            tabindex="-1"
            aria-labelledby="formCreditoModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formCreditoModalLabel">
                            Creditos
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
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cliente_id">Cliente</label>
                                    <v-select
                                        :options="listaClientes.data"
                                        label="nro_documento"
                                        aria-logname="{}"
                                        :reduce="nombres => nombres.id"
                                        v-model="formCredito.cliente_id"
                                        placeholder="Buscar por Documento"
                                    >
                                    </v-select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="deudor">Deudor</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="deudor"
                                        v-model="formCredito.deudor"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="sede_id">Sede</label>
                                    <v-select
                                        :options="listaSedes.data"
                                        label="sede"
                                        aria-logname="{}"
                                        :reduce="sede => sede.id"
                                        v-model="formCredito.sede_id"
                                    >
                                    </v-select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valor_credito"
                                        >Valor Credito</label
                                    >
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="valor_credito"
                                        step="any"
                                        v-model="formCredito.valor_credito"
                                    />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="interes">Interes</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="interes"
                                        v-model="formCredito.interes"
                                        step="any"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="cant_cuotas"
                                        >Cantidad Cuotas</label
                                    >
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="cant_cuotas"
                                        v-model="formCredito.cant_cuotas"
                                    />
                                </div>
                            </div>
                            <simulador
                                :capital="formCredito.valor_credito"
                                :interes="formCredito.interes"
                                :cant_cuotas="formCredito.cant_cuotas"
                                ref="Simulador"
                            ></simulador>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                                @click="editar = false"
                            >
                                Cerrar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary rounded"
                                @click="
                                    editar ? editarCredito() : crearCredito()
                                "
                            >
                                Guardar
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Simulador from "./Simulador.vue";
export default {
    components: { Simulador },
    data() {
        return {
            editar: false,
            listaSedes: [],
            listaClientes: [],
            formCredito: {
                cliente_id: "",
                deudor_id: 2,
                sede_id: "",
                cant_cuotas: "",
                cant_cuotas_pagadas: "",
                cant_cuotas_pagadas: "",
                dia_limite: "",
                deudor: "",
                estado: "1",
                fecha_inicio: "",
                interes: "",
                porcentaje_interes_anual: "",
                usu_crea: 2,
                calor_cuota: "",
                valor_credito: "",
                valor_abonado: "",
                valor_capital: "",
                valor_interes: ""
            }
        };
    },
    created() {
        this.listarSedes(1);
        this.listarClientes(1);
    },
    // Function crearCreditos
    methods: {
        listarSedes(page = 1) {
            let me = this;
            axios.get(`api/sedes?page=${page}`).then(function(response) {
                me.listaSedes = response.data;
            });
        },

        listarClientes(page = 1) {
            let me = this;
            axios.get(`api/clientes?page=${page}`).then(function(response) {
                me.listaClientes = response.data;
            });
        },
        crearCredito() {
            let me = this;
            axios.post("api/creditos", this.formCredito).then(function() {
                $("#formCreditoModal").modal("hide");
                me.resetData();
                this.$emit("listar-creditos");
            });
        },
        abirEditarCredito(credito) {
            this.editar = true;
            let me = this;
            $("#formCreditoModal").modal("show");
            me.formCredito = credito;
        },
        editarCredito() {
            let me = this;
            axios
                .put("api/creditos/" + this.formCredito.id, this.formCredito)
                .then(function() {
                    $("#formCreditoModal").modal("hide");
                    me.resetData();
                });
            this.$emit("listar-creditos");

            this.editar = false;
        },
        resetData() {
            let me = this;
            Object.keys(this.formCredito).forEach(function(key, index) {
                me.formCredito[key] = "";
            });
        }
    }
};
</script>
