<div class="col-md-12">
    <script type="text/javascript">
        $(function () {
            $('#visites_offres').highcharts({
                colors: ['#f39c12'],
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Nombre de visites par offre'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nb de visites'
                    }
                },
                legend: {
                    enabled: false
                },

                series: [{
                    name: 'Nb visites',
                    data: [

                            @foreach($visites_offre as $visite ) [
                            '{{$visite->titre_offre}}',{{$visite->visite_offre}}
                        ],@endforeach
                    ],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        });
    </script>
    <div id="visites_offres" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
