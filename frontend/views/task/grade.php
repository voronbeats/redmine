<?php

use miloschuman\highcharts\Highcharts;

?>



<?php
echo Highcharts::widget([
    'options' => '{
        "chart": {
            "plotBackgroundColor": null,
            "plotBorderWidth": null,
            "plotShadow": false
        },
        "title": {
            "text": "График успеваемости"
        },
        "tooltip": {
            "pointFormat": "{series.name}: <b>{point.percentage:.1f}%</b>"
        },
        "plotOptions": {
            "pie": {
                "allowPointSelect": true,
                "cursor": "pointer",
                "dataLabels": {
                    "enabled": true,
                   "color": "#000000",
                    "connectorColor": "#000000",
                    "format": "<b>{point.name}</b>: {point.percentage:.1f} %"
                }
            }
        },
        "series": [{
    "type": "pie",
           "name": "Успевавемость",
            "data": [
        '.$users.'
            ]
        }]
    }'
]);
?>