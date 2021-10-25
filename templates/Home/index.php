<div class="row">
    <div class="col">
        <table class="table requisicoesHome">
            <thead>
                <tr>
                    <th scope="col">URL</th>
                    <th scope="col">DATA</th>
                    <th scope="col">STATUS HTTP</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col">
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        $.ajax({
            type: "get",
            url: www_root + "/requisicoes/grafico",
            success: function(data) {

                var objArr = [['Status', 'Quantidade']];
                $.each(data.dados, function(idx, obj) {
                    objArr.push([idx + ' - HTTP response', obj]);
                });

                var data = google.visualization.arrayToDataTable(
                    objArr
                );

                var options = {
                    title: 'Retorno das Últimas 10 Requisições'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            },
        });


    }
</script>