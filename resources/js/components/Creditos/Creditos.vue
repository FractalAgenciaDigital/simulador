<template>
    <div class="page">
        <div class="page-header d-flex justify-content-between p-4 border my-2">
            <h3>Creditos</h3>
            <button
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#formCreditoModal"
            >
                Crear Credito
            </button>
        </div>
        <div class="page-search d-flex justify-content-between p-4 border my-2">
            <div class="form-group col-8 m-auto">
                <label for="buscar_cliente">Buscar Cliente...</label>
                <input
                    type="text"
                    id="buscar_cliente"
                    name="buscar_cliente"
                    class="form-control"
                    placeholder="Nombres | Documento"
                    @keypress="listarCreditos()"
                    v-model="buscar_cliente"
                />
            </div>
        </div>

        <div class="page-content mt-4" style="width: 100%">
            <section class="">
                <table class="table table-md table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Nro. Documento</th>
                            <th>Valor crédito</th>
                            <th>Valor Abonado</th>
                            <th>Nro Cuotas</th>
                            <th>Cuotas</th>
                            <th>Estado</th>
                            <!-- <th>Simular Crédito</th> -->
                            <th>Cuotas</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <!-- <tbody> -->
                    <tbody
                        v-if="
                            listaCreditos.data && listaCreditos.data.length > 0
                        "
                    >
                        <tr
                            v-for="credito in listaCreditos.data"
                            :key="credito.index"
                        >
                            <td>{{ credito.id }}</td>
                            <td>
                                {{ credito.nombres }} {{ credito.apellidos }}
                            </td>
                            <td>{{ credito.nro_documento }}</td>
                            <td>{{ credito.valor_credito }}</td>
                            <td>{{ credito.valor_abonado }}</td>
                            <td>{{ credito.cant_cuotas }}</td>
                            <td>{{ credito.cant_cuotas_pagadas }}</td>

                            <td v-if="credito.id_rol == 1">Administrador</td>
                            <td v-if="credito.id_rol == 2">Operario</td>
                            <td v-if="credito.estado == 1">Activo</td>
                            <td v-if="credito.estado == 0">Inactivo</td>
                            <!-- 
                            <td class="text-center">
                                <button
                                    v-if="credito.estado == 1"
                                    class="btn btn-outline-primary"
                                    @click="simularCredito()"
                                >
                                    <i class="bi bi-credit-card-2-back"></i>
                                </button>
                            </td> -->
                            <td class="text-center">
                                <button
                                    data-toggle="modal"
                                    data-target="#cuotasModal"
                                    v-if="credito.estado == 1"
                                    class="btn btn-outline-primary"
                                    @click="mostrarCuotas(credito.id)"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button
                                    v-if="credito.estado == 1"
                                    class="btn btn-outline-primary"
                                    @click="mostrarDatos(credito)"
                                >
                                    <i class="bi bi-pen"></i>
                                </button>
                                <button
                                    v-if="credito.estado == 1"
                                    class="btn btn-outline-danger"
                                    @click="CambiarEstado(credito.id)"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button
                                    v-if="credito.estado == 0"
                                    class="btn btn-outline-success"
                                    @click="CambiarEstado(credito.id)"
                                >
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <div v-else>
                        <div
                            class="alert alert-danger"
                            style="margin: 2px auto; width: 30%"
                        >
                            Si no encuentras el usuario deseado. Podrías
                            crearlo.
                        </div>
                        <div
                            class="alert alert-info"
                            style="margin: 2px auto; width: 30%"
                        >
                            Crear un nuevo Cliente
                            <button
                                type="button"
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#formClienteModal"
                            >
                                Crear Cliente
                            </button>
                        </div>
                    </div>
                </table>
                <pagination
                    :align="'center'"
                    :data="listaCreditos"
                    :limit="2"
                    @pagination-change-page="listarCreditos"
                >
                    <span slot="prev-nav"
                        ><i class="bi bi-chevron-double-left"></i
                    ></span>
                    <span slot="next-nav"
                        ><i class="bi bi-chevron-double-right"></i
                    ></span>
                </pagination>
            </section>
        </div>

        <crear-editar-cliente
            ref="CrearEditarCliente"
            @listar-clientes="listarCreditos(1)"
        />
        <crear-editar-credito
            ref="CrearEditarCredito"
            @listar-creditos="listarCreditos(1)"
        />
        <!-- <simulador ref="Simulador"></simulador> -->

        <cuotas ref="Cuotas" />
    </div>
</template>
<script>
import CrearEditarCredito from "./CrearEditarCredito.vue";
import Simulador from "./Simulador.vue";
import CrearEditarCliente from "./../Clientes/CrearEditarCliente.vue";
import Cuotas from "./Cuotas.vue";

export default {
    components: { CrearEditarCredito, Simulador, CrearEditarCliente, Cuotas },

    props: {
        cuotas: {
            type: Object
        }
    },
    data() {
        return {
            buscar_cliente: "",
            listaCreditos: {},
            listaClientes: {}
        };
    },
    created() {
        this.listarCreditos(1);
    },
    methods: {
        listarCreditos(page = 1) {
            let me = this;
            axios
                .get(`api/creditos?page=${page}&credito=${this.buscar_cliente}`)
                .then(function(response) {
                    console.log(response);
                    me.listaCreditos = response.data;
                });
        },
        listarClientes(page = 1) {
            let me = this;
            axios
                .get(`api/clientes?page=${page}&cliente=${this.buscar_cliente}`)
                .then(function(response) {
                    me.listaClientes = response.data;
                });
        },
        mostrarDatos: function(credito) {
            this.$refs.CrearEditarCredito.abirEditarCredito(credito);
        },
        simularCredito: function() {
            this.$refs.Simulador.abrirSimulador();
        },
        mostrarCuotas: function(credito) {
            this.$refs.Cuotas.listarCuotasCredito(credito);
        },
        mostrarDatosCliente: function(cliente) {
            this.$refs.CrearEditarCliente.abirEditarCliente(cliente);
        },
        CambiarEstado: function(id) {
            let me = this;

            Swal.fire({
                title: "¿Quieres cambiar el estado del credito?",
                showDenyButton: true,
                denyButtonText: `Cancelar`,
                confirmButtonText: `Guardar`
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .post(
                            "api/creditos/" + id + "/cambiar-estado",
                            null,
                            me.$root.config
                        )
                        .then(function() {
                            me.listarCreditos(1);
                        });
                    Swal.fire("Cambios realizados!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Operación no realizada", "", "info");
                }
            });
        }
    } //End of methods
};
</script>
