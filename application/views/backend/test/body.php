
    <!-- START OF RIGHT PANEL -->
                 	<div style="background:black;">
                    
						
                                            <?php 
                                           	$arraylog = array();
											$n = 0;
											foreach ($log->result() as $log){ 
                                          
												$arraylog[$n][0] = $n;
												$arraylog[$n][1] = $log->TMA;
												$n = $n +1;
												 } ?>

											<?php 
											$arraylog2 = array();
											$n = 0;
											foreach ($curah->result() as $curah){ 
                                          
												$arraylog2[$n][0] = $n;
												$arraylog2[$n][1] = $curah->nilai;
												$n = $n +1;
												 } ?>
                                      		
                                            <?php 
											$arraylogvw = array();
											$n = 0;
											foreach ($vw1->result() as $log1){ 
                                          
												$arraylogvw[$n][0] = $n;
												$arraylogvw[$n][1] = $log1->tap;
												$n = $n +1;
												 } ?>
                                            <?php 
											$arraylog2vw = array();
											$n = 0;
											foreach ($vw2->result() as $log2){ 
                                          
												$arraylog2vw[$n][0] = $n;
												$arraylog2vw[$n][1] = $log2->tap;
												$n = $n +1;
												 } ?>
                                            <?php 
											$arraylog3 = array();
											$n = 0;
											foreach ($vw3->result() as $log3){ 
                                          
												$arraylog3vw[$n][0] = $n;
												$arraylog3vw[$n][1] = $log3->tap;
												$n = $n +1;
												 } ?>
                                            <?php 
											$arraylog4vw = array();
											$n = 0;
											foreach ($vw4->result() as $log4){ 
                                          
												$arraylog4vw[$n][0] = $n;
												$arraylog4vw[$n][1] = $log4->tap;
												$n = $n +1;
												 } ?>
                                            <?php 
											$arraylog5vw = array();
											$n = 0;
											foreach ($vw5->result() as $log5){ 
                                          
												$arraylog5vw[$n][0] = $n;
												$arraylog5vw[$n][1] = $log5->tap;
												$n = $n +1;
												 } ?>          
         
	<div id="legendContainer"></div>    
	<div id="<?php echo $kode; ?>" style="height:410px;"></div>                    

                    </div><!--span8-->
    <!-- END OF RIGHT PANEL -->
	
<script>
//******* 2012 Gold Price Chart
var data1 = [
    [gd(2012, 0, 1), 1652.21], [gd(2012, 1, 1), 1742.14], [gd(2012, 2, 1), 1673.77], [gd(2012, 3, 1), 1649.69],
    [gd(2012, 4, 1), 1591.19], [gd(2012, 5, 1), 1598.76], [gd(2012, 6, 1), 1589.90], [gd(2012, 7, 1), 1630.31],
    [gd(2012, 8, 1), 1744.81], [gd(2012, 9, 1), 1746.58], [gd(2012, 10, 1), 1721.64], [gd(2012, 11, 2), 1684.76]
];

var data2 = [
    [gd(2012, 0, 1), 0.63], [gd(2012, 1, 1), 5.44], [gd(2012, 2, 1), -3.92], [gd(2012, 3, 1), -1.44],
    [gd(2012, 4, 1), -3.55], [gd(2012, 5, 1), 0.48], [gd(2012, 6, 1), -0.55], [gd(2012, 7, 1), 2.54],
    [gd(2012, 8, 1), 7.02], [gd(2012, 9, 1), 0.10], [gd(2012, 10, 1), -1.43], [gd(2012, 11, 2), -2.14]
];
var dataset = [
    { label: "Gold Price", data: data1, points: { symbol: "triangle"} },
    { label: "Change", data: data2, yaxis: 2 }
];

var options = {
    series: {
        lines: {
            show: true
        },
        points: {
            radius: 3,
            fill: true,
            show: true            
        }
    },
    xaxis: {
        mode: "time",
        tickSize: [1, "month"],        
        tickLength: 0,
        axisLabel: "2012",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Verdana, Arial',
        axisLabelPadding: 10
    },
    yaxes: [{
            axisLabel: "Gold Price(USD)",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3,
            tickFormatter: function (v, axis) {
                return $.formatNumber(v, { format: "#,###", locale: "us" });
            }
        }, { 
            position: "right",
            axisLabel: "Change(%)",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 3
        }
    ],
    legend: {
        noColumns: 0,
        labelBoxBorderColor: "#000000",
        position: "nw"
    },
    grid: {
        hoverable: true,
        borderWidth: 2,
        borderColor: "#633200",
        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
    },
    colors: ["#FF0000", "#0022FF"]
};

$(document).ready(function () {
    $.plot($("<?php echo '#'.$kode; ?>"), dataset, options);
    $("<?php echo '#'.$kode; ?>").UseTooltip();
});




function gd(year, month, day) {
    return new Date(year, month, day).getTime();
}

var previousPoint = null, previousLabel = null;
var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

$.fn.UseTooltip = function () {
    $(this).bind("plothover", function (event, pos, item) {
        if (item) {
            if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                previousPoint = item.dataIndex;
                previousLabel = item.series.label;
                $("#tooltip").remove();

                var x = item.datapoint[0];
                var y = item.datapoint[1];

                var color = item.series.color;
                var month = new Date(x).getMonth();

                //console.log(item);

                if (item.seriesIndex == 0) {
                    showTooltip(item.pageX,
                            item.pageY,
                            color,
                            "<strong>" + item.series.label + "</strong><br>" + monthNames[month] + " : <strong>" + y + "</strong>(USD)");
                } else {
                    showTooltip(item.pageX,
                            item.pageY,
                            color,
                            "<strong>" + item.series.label + "</strong><br>" + monthNames[month] + " : <strong>" + y + "</strong>(%)");
                }
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};

function showTooltip(x, y, color, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y - 40,
        left: x - 120,
        border: '2px solid ' + color,
        padding: '3px',
        opacity: 0.9
    }).appendTo("body").fadeIn(200);
}




</script>

