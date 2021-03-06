Vue.component('vue-simulador', {
    props: ['capital', 'plazos', 'tasa'],
    data: function() {
        return {
           lista: []
        }
    },
    template: `
                <table border="1" class="table table-striped- table-bordered table-hover table-checkable text-center" id="kt_table_2">
                    <caption  style="text-align:center">Tabla de amortizaciónes</caption>
                    <thead>
                    <tr >
                        <th class=""># Quincena</th>
                        <th class="">Saldo de Deuda</th>                        
                        <th class="">Amortización</th>
                        <th class="">Interés</th>                        
                        <th class="">Descuento</th>
                        <th class="">Iva</th>
                        <th class="">Descuento Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in lista"> <!-- Recorremos nuestro array -->
                        <td class="quincena"> {{ item.quincena}}</td> 
                        <td class="pagado"> {{ item.pagado }}</td>                        
                        <td class="capital"> {{ item.amortizacion }}</td>                        
                        <td class="interes"> {{ item.interes }}</td>
                        <td class="descuento"> {{ item.descuento }}</td>
                        <td class="iva"> {{ item.iva }}</td>
                        <td class="iva"> {{ item.cuotaTotal }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Totales</td>
                        <td>{{ totalamortizacion }}</td>
                        <td>{{ totalinteres }}</td>
                        <td>{{ totaldescuento }}</td>
                        <td>{{ totalIva }}</td>
                        <td>{{ totalImporte }}</td>
                    </tr>
                </tfoot>
            </table>                       
                  `,
    methods: {
        Initialize: function() {
            this.Calcular();
        },
        Calcular: function() {
            function humanizeNumber(n) {
                n = n.toString()
                while (true) {
                    var n2 = n.replace(/(\d)(\d{3})($|,|\.)/g, '$1,$2$3')
                    if (n == n2) break
                    n = n2
                }
                return n
            }

            const formatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            })

            var montoPrestamo = parseFloat(this.capital);
            var numPagos = parseInt(this.plazos);
            var tasaAnual = parseFloat(this.tasa);
            var iva = .16;


            tasaAnual = tasaAnual / 100;
			var tasaDiaria = tasaAnual * (1 + iva) / 360;

            var quincena = tasaDiaria * 15;
            var _descuento = (montoPrestamo * quincena) / (1 - Math.pow(1 + quincena, -numPagos));

            var nuevoMontoPrestado = montoPrestamo;
            //TOTALES
            this.totaldescuento = 0;
            this.totalinteres = 0;
            this.totalamortizacion = 0;
            this.totalIva = 0;
            this.totalImporte = 0;

            ///Primera iteración
            var itemFirts = {
                quincena: 0,
                pagado: humanizeNumber(formatter.format(montoPrestamo.toFixed(2)))
            }
            this.lista.push(itemFirts); //añadimos el la variable item al array
            ///Calculos
            var i = 1;
            while (i <= numPagos) {
                var nuevoInteres = (quincena * nuevoMontoPrestado) / (1+iva);
                var ivaDesglose = nuevoInteres * iva;
                
                var amortizacion = _descuento - (nuevoInteres+ivaDesglose);
                
                var cuotaTOTAL = (amortizacion + nuevoInteres + ivaDesglose);
                nuevoMontoPrestado = nuevoMontoPrestado - amortizacion;
                
                var item = {
                    quincena: i,
                    descuento: humanizeNumber(formatter.format(_descuento.toFixed(4))),
                    iva: humanizeNumber(formatter.format(ivaDesglose.toFixed(4))),
                    interes: humanizeNumber(formatter.format(nuevoInteres.toFixed(4))),
                    amortizacion: humanizeNumber(formatter.format(amortizacion.toFixed(4))),
                    pagado: humanizeNumber(formatter.format(nuevoMontoPrestado.toFixed(4))),
                    cuotaTotal: humanizeNumber(formatter.format(cuotaTOTAL.toFixed(4)))
                }
                this.lista.push(item); //añadimos el la variable item al array
                i++;
                //SUMA TOTALES
                this.totaldescuento = parseFloat(this.totaldescuento) + parseFloat(_descuento);
                this.totalinteres = parseFloat(this.totalinteres) + parseFloat(nuevoInteres);
                this.totalamortizacion = parseFloat(this.totalamortizacion) + parseFloat(amortizacion);
                this.totalIva = parseFloat(this.totalIva) + parseFloat(ivaDesglose);
                this.totalImporte = parseFloat(this.totalImporte) + parseFloat(cuotaTOTAL);
            }
            //FORMATO MONEDA TOTALES
            this.totaldescuento = humanizeNumber(formatter.format(this.totaldescuento.toFixed(2)));
            this.totalinteres = humanizeNumber(formatter.format(this.totalinteres.toFixed(2)));
            this.totalamortizacion = humanizeNumber(formatter.format(this.totalamortizacion.toFixed(2)));
            this.totalIva = humanizeNumber(formatter.format(this.totalIva.toFixed(2)));
            this.totalImporte = humanizeNumber(formatter.format(this.totalImporte.toFixed(2)));
        }
    },
    created() {
        this.Initialize();
    }
});


var app = new Vue({
    el: '#vue-simulador'
});