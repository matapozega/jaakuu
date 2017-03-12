<?php
include_once '../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
	exit;
}


 ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once '../predlozak/topbar.php';
		?>
		<div class="row">
			<div class="large-12 columns" id="container" style="min-width: 100px; height: 500px; margin: 0 auto"></div>
		</div>
		<?php include_once '../predlozak/footer.php'
		?>
		<?php
		include_once '../predlozak/skripte.php';
		?>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script>
			$(function () {

    $(document).ready(function () {

        // Build the chart
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '3 najigranija tipa ponude'
            },
             tooltip: {
                pointFormat: '<b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true
                    },
                    showInLegend: true
                }
            },
            series: [{
                colorByPoint: true,
                data: [
                
                <?php
							$izraz=$veza->prepare("select count(a.listic) as broj ,c.naziv from listic_ponuda a inner join
													ponuda b on a.ponuda=b.sifra inner join tipponude c on c.sifra=b.tipponude
													group by c.naziv
													order by broj desc limit 3
							");
							$izraz->execute();
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							foreach ($niz as $red) {
								echo "{name: '". $red->naziv  . "',y: " . $red-> broj . "}, ";
							}
				
				 ?>
                
               
                ]
                
            }]
        });
    });
});
		</script>
	</body>
</html>