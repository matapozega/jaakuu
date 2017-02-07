<?php
include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
	header("location: ../logout.php");
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
                text: '5 najigranijih tipova ponude'
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
							$izraz=$veza->prepare("select g.naziv as naziv, count(e.tipponude) as tip
													from korisnik a inner join listic b on a.sifra=b.korisnik
													inner join listic_ponuda d on b.sifra=d.listic
													inner join ponuda e on e.sifra=d.ponuda
													inner join video f on f.sifra=e.video
													inner join tipponude g on g.sifra=e.tipponude
													group by e.sifra
													order by tip desc limit 5
							");
							$izraz->execute();
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							foreach ($niz as $red) {
								echo "{name: '" . $red->naziv . "',y: " . $red-> tip . "}, ";
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