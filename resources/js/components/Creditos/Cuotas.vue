<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="cuotasModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="cuotasModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cuotasModalLabel">
                        Listado de Cuotas
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha de vencimiento</th>
                                    <th scope="col">Nro. Cuota</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Capital</th>
                                    <th>Interés</th>
                                    <th>Mora</th>
                                    <th>Dias de mora</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(c, index) in listadoCuotas"
                                    :key="c.id"
                                >
                                    <th>{{ c.fecha_pago }}</th>
                                    <td>{{ c.nro_cuota }}</td>
                                    <td>{{ c.valor }}</td>
                                    <td>{{ c.valor_pago_capital }}</td>
                                    <td>{{ c.valor_pago_interes }}</td>
                                    <td>{{ c.valor_interes_mora }}</td>
                                    <td>{{ c.dias_mora }}</td>
                                    <td>
                                        <span
                                            v-if="c.estado == 0"
                                            class=" badge badge-secondary"
                                            >Pendiente</span
                                        >
                                        <span
                                            v-if="c.estado == 1"
                                            class="badge badge-success"
                                            >Pagado</span
                                        >
                                    </td>
                                    <td>
                                        <button
                                            @click="pagarCuota(c.id)"
                                            class="btn btn-success"
                                        >
                                            Pagar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Close
                    </button>
                    <!-- <button type="button" class="btn btn-primary">
                        Save changes
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    // props: ["credito_id"],
    data() {
        return {
            id_credito: 0,
            listadoCuotas: []
        };
    },
    methods: {
        listarCuotasCredito(credito_id) {
            this.id_credito = credito_id;
            let me = this;
            axios
                .get(`api/creditos/${credito_id}/cuotas`)
                .then(function(response) {
                    me.listadoCuotas = response.data;
                });
        },

        pagarCuota(id) {
            let me = this;
            axios.post(`api/cuota/${id}/pagar-cuota`).then(function(response) {
                me.listarCuotasCredito(me.id_credito);
            });
        }
    }
};
</script>
