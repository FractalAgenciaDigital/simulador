<template>
    <div>
        <div
            class="modal fade"
            id="formSedeModal"
            tabindex="-1"
            aria-labelledby="formSedeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formSedeModalLabel">
                            Sedes
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
                                    <label for="sede">Sede</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="sede"
                                        v-model="formSede.sede"
                                    />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="direccion">Dirección</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="direccion"
                                        v-model="formSede.direccion"
                                    />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nit">NIT</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="nit"
                                        v-model="formSede.nit"
                                    />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="correo_contacto"
                                        >Correo Contacto</label
                                    >
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="correo_contacto"
                                        v-model="formSede.correo_contacto"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="representante"
                                        >Representante</label
                                    >

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="representante"
                                        v-model="formSede.representante"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="celular_contacto"
                                        >Celular Contacto</label
                                    >

                                    <input
                                        type="number"
                                        class="form-control"
                                        id="celular_contacto"
                                        v-model="formSede.celular_contacto"
                                    />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="impresora_pos"
                                        >Impresora POS</label
                                    >
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="impresora_pos"
                                        v-model="formSede.impresora_pos"
                                    />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
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
                            @click="editar ? editarSede() : crearSede()"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            editar: false,
            formSede: {
                name: "",
                email: "",
                password: "",
                nombre: "",
                celular: "",
                direccion: "",
                tipo_documento: 0,
                documento: 0,
                foto: "",
                estado: "1",
                id_rol: "",
                sede_id: "",
                impresora_pos: ""
            }
        };
    },
    // Function crearSedes
    methods: {
        crearSede() {
            let me = this;
            axios.post("api/sedes", this.formSede).then(function() {
                $("#formSedeModal").modal("hide");
                me.resetData();
                me.$emit("listar-sedes");
            });
        },
        abirEditarSede(sede) {
            this.editar = true;
            let me = this;
            $("#formSedeModal").modal("show");
            me.formSede = sede;
        },
        editarSede() {
            let me = this;
            axios
                .put(`api/sedes/${this.formSede.id}`, this.formSede)
                .then(function() {
                    $("#formSedeModal").modal("hide");
                    me.resetData();
                });
            me.$emit("listar-sedes");

            me.editar = false;
        },
        resetData() {
            let me = this;
            Object.keys(this.formSede).forEach(function(key, index) {
                me.formSede[key] = "";
            });
        }
    }
};
</script>
