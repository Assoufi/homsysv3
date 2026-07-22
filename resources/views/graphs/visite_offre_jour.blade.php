<script type="text/javascript">
    $(function () {
        $('#visite_offre_jour').highcharts({
            colors: ['#f39c12'],
            title: {
                text: 'Nombre de visite par jour' ,
                x: -20 //center
            },

            xAxis: {
                categories: [@foreach($visite_offre_jour as $visite )
                        '{{$visite->jour}}',
                    @endforeach]
            },
            yAxis: {
                title: {
                    text: 'Nb de visites'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#e67e22'
                }]
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Nb visites',
                data: [@foreach($visite_offre_jour as $visite)
                    {{$visite->visites}},
                    @endforeach]
            }]
        });
    });
</script>
<div class="col-md-12" align="center">
    <div id="visite_offre_jour" ></div>
</div>