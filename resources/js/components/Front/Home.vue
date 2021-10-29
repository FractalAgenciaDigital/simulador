<template>
    <div class="page">
        <div class="page-header text-center">
            <h2>SImulador de Crédito</h2>
            <p>Puedes hacer una simulacion de tu crédito</p>
        </div>
        <div class="page-content">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="monto">Monto</label>
                    <input
                        required
                        type="number"
                        class="form-control"
                        id="monto"
                        v-model="capital"
                        placeholder="Ingresar monto"
                    />
                </div>
                <div class="form-group col-md-4">
                    <label for="tiempo">Tiempo en Meses</label>
                    <input
                        required
                        type="number"
                        class="form-control"
                        id="tiempo"
                        v-model="nro_cuotas"
                        placeholder="Ingresar cantidad de meses"
                    />
                </div>
                <div class="form-group col-md-4">
                    <label for="interes">Interés Mensual</label>
                    <input
                        required
                        type="number"
                        class="form-control"
                        id="interes"
                        v-model="interes"
                        placeholder="Ingresar tasa de interés mensual"
                    />
                </div>
            </div>

            <simulador
                :capital="capital"
                :interes="interes"
                :nro_cuotas="nro_cuotas"
                ref="Simulador"
            ></simulador>
        </div>
    </div>
</template>

<script>
import Simulador from "../Creditos/Simulador.vue";
export default {
    components: { Simulador },
    data() {
        return {
            interes: 3,
            capital: 500000,
            nro_cuotas: 12
        };
    },
    methods: {
        simularCredito: function() {
            this.$refs.Simulador.abrirSimulador();
        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
