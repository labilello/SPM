<div class="px-3 mb-3" wire:ignore>
    <h5 class="card-title">Graficas de la tabla</h5>
    <div class="row rounded-sm shadow-sm bg-white py-3">
        <div class="col-lg-3 col-12">
            <div class="nav flex-column flex-md-row justify-content-md-between justify-content-lg-start flex-lg-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link text-center text-lg-left" id="v-grafico-dia-tab" data-toggle="pill" href="#v-grafico-dia" role="tab" aria-controls="v-grafico-dia" aria-selected="false">Ingresos por dia</a>
                <a class="nav-link text-center text-lg-left" id="v-grafico-estado-tab" data-toggle="pill" href="#v-grafico-estado" role="tab" aria-controls="v-grafico-estado" aria-selected="false">Segun su estado actual</a>
                <a class="nav-link text-center text-lg-left" id="v-grafico-familia-tab" data-toggle="pill" href="#v-grafico-familia" role="tab" aria-controls="v-grafico-familia" aria-selected="false">Segun su familia</a>
                <a class="nav-link text-center text-lg-left" id="v-grafico-reparado-tab" data-toggle="pill" href="#v-grafico-reparado" role="tab" aria-controls="v-grafico-reparado" aria-selected="false">Segun su resolución</a>
            </div>
        </div>
        <div class="col-lg-9 col-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade mt-4 mt-lg-0" id="v-grafico-dia" role="tabpanel" aria-labelledby="v-grafico-dia-tab">
                    <div style="max-height: 250px">
                        <canvas id="days"></canvas>
                    </div>
                </div>
                <div class="tab-pane fade mt-4 mt-lg-0" id="v-grafico-estado" role="tabpanel" aria-labelledby="v-grafico-estado-tab">
                    <div style="max-height: 250px">
                        <canvas id="states"></canvas>
                    </div>
                </div>
                <div class="tab-pane fade mt-4 mt-lg-0" id="v-grafico-familia" role="tabpanel" aria-labelledby="v-grafico-familia-tab">
                    <div style="max-height: 250px">
                        <canvas id="families"></canvas>
                    </div>
                </div>
                <div class="tab-pane fade mt-4 mt-lg-0" id="v-grafico-reparado" role="tabpanel" aria-labelledby="v-grafico-reparado-tab">
                    <div style="max-height: 250px">
                        <canvas id="repaired"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('custom-scripts')
    <script>
        let daysCanvas = document.getElementById('days').getContext('2d');
        let familiesCanvas = document.getElementById('families').getContext('2d');
        let statesCanvas = document.getElementById('states').getContext('2d');
        let repairedCanvas = document.getElementById('repaired').getContext('2d');

        window.charts = [];

        window.charts.push( new Chart(daysCanvas, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Ingresos por Dia',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                parsing: {
                    xAxisKey: 'dateString',
                    yAxisKey: 'cant'
                },
            }
        }) );
        window.charts.push( new Chart(familiesCanvas, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    label: 'Reparaciones por Familia',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        '#AAA',
                        '#777',
                        'hsl(0, 20%, 60%)',
                        'hsl(0, 20%, 35%)',
                        'hsl(100, 20%, 60%)',
                        'hsl(100, 20%, 35%)',
                        'hsl(180, 20%, 60%)',
                        'hsl(180, 20%, 35%)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        '#AAA',
                        '#777',
                        'hsl(0, 60%, 60%)',
                        'hsl(0, 60%, 35%)',
                        'hsl(100, 60%, 60%)',
                        'hsl(100, 60%, 35%)',
                        'hsl(180, 60%, 60%)',
                        'hsl(180, 60%, 35%)',
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        align: 'center',
                    }
                }
                // parsing: {
                //     xAxisKey: 'family',
                //     yAxisKey: 'cant'
                // },
            }
        }) );
        window.charts.push( new Chart(statesCanvas, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Reparaciones por Estado',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                parsing: {
                    xAxisKey: 'state',
                    yAxisKey: 'cant'
                },
            }
        }) );
        window.charts.push( new Chart(repairedCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Reparado', 'Irreparable', 'Desconocido'],
                datasets: [{
                    label: 'Estado de reparacion',
                    data: [5,4,2],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        align: 'center',
                    }
                }
            },
        }) );


        formatDataToCharts(@json($this->getQuery()->get()));
        Livewire.on('tableUpdated', (data) => { formatDataToCharts(data) });

        function formatDataToCharts(data) {
            let dataCharts = [ [], [], [], [] ];

            data.forEach(function(elemento) {
                formatDataToDays(elemento, dataCharts[0]);
                formatDataToFamilies(elemento, dataCharts[1]);
                formatDataToStates(elemento, dataCharts[2]);
                formatDataToRepaired(elemento, dataCharts[3]);
            });

            dataCharts[0].sort( (a,b) => { return a.timestamp - b.timestamp } );

            // dataCharts.forEach(function (dataChart, index) {
            //     updateData( window.charts[index], dataChart );
            // });
            updateData( window.charts[0], dataCharts[0] );
            updateDataWithLabels( window.charts[1], dataCharts[1] );
            updateData( window.charts[2], dataCharts[2] );
            updateDataWithLabels( window.charts[3], dataCharts[3] );
        }

        function formatDataToDays(elemento, dataArray) {
            let fecha = new Date(elemento.date_in); // Lo convierto a Date
            fecha.setHours(0); fecha.setMinutes(0); fecha.setSeconds(0);
            let indexFind = dataArray.findIndex(element => element.timestamp === fecha.getTime());

            if (indexFind !== -1)
                dataArray[indexFind].cant += 1;
            else
                dataArray.push({timestamp: fecha.getTime(), dateString: fecha.toLocaleDateString(), cant: 1});
        }

        function formatDataToFamilies(elemento, dataArray) {
            let indexFind = dataArray.findIndex(element => element.label === elemento['product.familia']);

            if (indexFind !== -1)
                dataArray[indexFind].cant += 1;
            else
                dataArray.push({label: elemento['product.familia'], cant: 1});
        }

        function formatDataToStates(elemento, dataArray) {
            let indexFind = dataArray.findIndex(element => element.state === elemento['status.descripcion']);

            if (indexFind !== -1)
                dataArray[indexFind].cant += 1;
            else
                dataArray.push({state: elemento['status.descripcion'], cant: 1});
        }

        function formatDataToRepaired(elemento, dataArray) {
            let indexFind = dataArray.findIndex(element => element.repaired === elemento['is_repair']);

            if (indexFind !== -1)
                dataArray[indexFind].cant += 1;
            else
                dataArray.push({
                    repaired: elemento['is_repair'],
                    label: (elemento['is_repair'] === 1 ? 'Reparado' : elemento['is_repair'] === 0 ? 'Irreparable' : 'Desconocido'),
                    cant: 1
                });
        }

        function updateData(chart, data) {
            chart.data.labels = [];
            chart.data.datasets[0].data = data
            chart.update();
        }

        function updateDataWithLabels(chart, data) {
            let labels = [];
            let datas = [];
            data.forEach( function (element) {
                labels.push( element.label );
                datas.push( element.cant )
            })

            chart.data.labels = labels;
            chart.data.datasets[0].data = datas;
            chart.update();
        }

    </script>
@endpush
