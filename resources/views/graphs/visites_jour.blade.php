<script type="text/javascript">
    $(function () {
        $('#visite_jour').highcharts({
            colors: ['#f39c12'],
            title: {
                text: 'Nombre de visite par jour',
                x: -20 //center
            },

            xAxis: {
                categories: [
                    @if(!empty($visite_jour) && collect($visite_jour)->isNotEmpty())
                        @foreach($visite_jour as $visite )
                            '{{$visite->jour}}',
                        @endforeach
                    @else
                        'No data'
                    @endif
                ]
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
                data: [
                    @if(!empty($visite_jour) && collect($visite_jour)->isNotEmpty())
                        @foreach($visite_jour as $visite)
                            {{$visite->visite}},
                        @endforeach
                    @else
                        0
                    @endif
                ]
            }]
        });
    });
</script>
<div class="col-md-12">
    <div id="visite_jour" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>