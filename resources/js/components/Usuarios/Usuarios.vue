<template>
    <div>
        <section>
            <table class="table table-sm table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Documento</th>
                        <th>Celular</th>
                        <td>Sede</td>
                        <td>Rol</td>
                        <td>Estado</td>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in listaClientes.data" :key="c.id">
                        <td>{{ c.id }}</td>
                        <td>{{ c.nombres }} {{ c.apellidos }}</td>
                        <td>{{ c.nro_documento }}</td>
                        <td>( {{ c.celular1 }} ) - ( {{ c.celular2 }} )</td>
                        <td>{{ c.email }}</td>
                        <td>{{ c.direccion }}</td>
                        <td></td>
                        <th>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {
            listaClientes: {}
        };
    },
    created() {
        this.listarClientes(1);
    },
    methods: {
        listarClientes(page = 1) {
            let me = this;
            axios.get("api/clientes?page=" + page).then(function(response) {
                me.listaClientes = response.data;
            });
        }
    }
};
</script>
