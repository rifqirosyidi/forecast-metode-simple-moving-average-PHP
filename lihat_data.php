<?php
// error_reporting(0);
require 'connect.php';

$records = array();

$result = $db->query("SELECT * FROM simple_moving");

if ($result) {
	if ($result->num_rows){
		while ($row = $result->fetch_object()){
			$records[] = $row;
		}
		$result->free();
	}
}

if (isset($_POST['prediksi'])){

		if(count($records) >= 6 ) {

			$enam = $db->query("SELECT perolehan FROM simple_moving ORDER BY id DESC LIMIT 6");
			$tiga = $db->query("SELECT perolehan FROM simple_moving ORDER BY id DESC LIMIT 3");

			while($enamFetch = $enam->fetch_object()) {
				$arrEnam[] = $enamFetch;
			}
			foreach($arrEnam as $e) {
				$b[] = $e->perolehan;
			}

			$e1 = $b[0];
			$e2 = $b[1];
			$e3 = $b[2];
			$e4 = $b[3];
			$e5 = $b[4];
			$e6 = $b[5];

			while($tigaFetch = $tiga->fetch_object()) {
				$arrTiga[] = $tigaFetch;
			}
			foreach($arrTiga as $t) {
				$a[] = $t->perolehan;
			}

			$t1 = $a[0];
			$t2 = $a[1];
			$t3 = $a[2];


			$averageEnam = round((($e1 + $e2 + $e3 + $e4 + $e5 + $e6) / 6), 2);
			$averageTiga = round( (($t1 + $t2 + $t3) / 3), 2);

			$insertForecast = $db->query("INSERT INTO simple_moving (fore_3, fore_6) VALUES ('$averageTiga', '$averageEnam')");

			if ($insertForecast) {
				header("Refresh:0");
			}

			// LANJUT

		} else if (count($records) >= 3){

			$tiga = $db->query("SELECT perolehan FROM simple_moving ORDER BY id DESC LIMIT 3");

			while($tigaFetch = $tiga->fetch_object()) {
				$arrTiga[] = $tigaFetch;
			}
			foreach($arrTiga as $t) {
				$a[] = $t->perolehan;
			}

			$t1 = $a[0];
			$t2 = $a[1];
			$t3 = $a[2];

			$averageTiga = round((($t1 + $t2 + $t3) / 3), 2);

			$insertForecast3 = $db->query("INSERT INTO simple_moving (fore_3) VALUES ('$averageTiga')");
			if ($insertForecast3) {
				header("Refresh:0");
			}

		} else {
			echo "DATA KURANG DARI 3";
		}
}

if (count($records) < 3 ) {
	if (isset($_POST['input'])){

		$inputData = $_POST['inputData'];
		$input = $db->query("INSERT INTO simple_moving (perolehan) VALUES ('$inputData')");

		if ($input) {
			header("Refresh:0");
		}

	}
}

$cekFore3 = $db->query("SELECT fore_3 from simple_moving ORDER BY id DESC LIMIT 1");
$cekFore6 = $db->query("SELECT fore_6 from simple_moving ORDER BY id DESC LIMIT 1");

		while($data3 = $cekFore3->fetch_object()){
			$d3[] = $data3;
		}
		foreach ($d3 as $val3 ) {
			$l3 = $val3->fore_3;
		} // LAST FORECAST VALUE 3

		while($data6 = $cekFore6->fetch_object()){
			$d6[] = $data6;
		}
		foreach ($d6 as $val6 ) {
			$l6 = $val6->fore_6;
		} // LAST FORECAST VALUE 6

		$lastVal3 = $l3;
		$lastVal6 = $l6;


if(isset($_POST['input'])){
	if($lastVal3 == 0) {
		echo "<script>
					alert('Harap Lihat Forecast Lebih Dulu Sebagai Acuan');
				</script>";
	}
}


if(isset($_POST['input'])) {
	if (count($records) > 6) {

						$inputData = $_POST['inputData'];

						$mad3 = round( (abs( $inputData - $lastVal3)), 2);
						$mse3 = round(($mad3 * $mad3), 2);

						$mad6 = round( (abs( $inputData - $lastVal6)), 2);
						$mse6 = round(($mad6 * $mad6), 2);

						$mape3 = round((100 * ($mad3 / $inputData)), 2);
						$mape6 = round((100 * ($mad6 / $inputData)), 2);



						$input = $db->query("UPDATE simple_moving
																		SET perolehan = '$inputData',
																				mad_3 = '$mad3',
																				mad_6 = '$mad6',
																				mse_3 = '$mse3',
																				mse_6 = '$mse6',
																				mape_3 = '$mape3',
																				mape_6 = '$mape6'
																				WHERE perolehan = 0") ;

						if ($input) {
							echo "<script>
											alert('Data Aktual Berhasil diupdate');
										</script>";

							header("Refresh:0");
						}



	} else if (count($records) >= 3) {

						$inputData = $_POST['inputData'];

						$mad3 = round((abs( $inputData - $lastVal3)), 2);
						$mse3 = round(($mad3 * $mad3 ), 2);
						$mape3 = round((100 * ($mad3 / $inputData)), 2);

						$input = $db->query("UPDATE simple_moving
																		SET perolehan = '$inputData',
																				mad_3 = '$mad3',
																				mse_3 = '$mse3',
																				mape_3 = '$mape3'
																				WHERE perolehan = 0") ;

						if ($input) {
							echo "<script>
											alert('Data Aktual Berhasil diupdate');
										</script>";

							header("Refresh:0");
						}
	}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script>
		function showPrompt() {
			var x;
	        var site = prompt("Masukkan Data", "");
        	if (site != null) {
            	x = site;
            	document.getElementById("demo").value = x;
			}
		}
	</script>
</head>
<body>

	<div class="limiter">
		<h1 class="judul">Simple Moving Average / Total Historical Method</h1>
		<p class="subJudul">Peramalan / Forecast Data Tambak Ikan</p>



		<div class="container-table100">
			<div class="wrap-table100">
				<?php if (!count($records)) {
					echo "<p class='subJudul'> No Records </p>";
				} else {
				?>
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Bulan</th>
								<th class="column2">Perolehan</th>
								<th class="column3">Fore 3 Bln</th>
								<th class="column4">Fore 6 Bln</th>
								<th class="column5">MAD 3 Bln</th>
								<th class="column6">MAD 6 Bln</th>
								<th class="column7">MSE 3 Bln</th>
								<th class="column8">MSE 6 Bln</th>
								<th class="column9">MAPE 3 Bln</th>
								<th class="column10">MAPE 6 Bln</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($records as $r) { ?>

								<tr>
									<td class="column1"><?php echo $i; ?></td>
									<td class="column2"><?php echo $r->perolehan . " Kg"; ?></td>
									<td class="column3"><?php echo $r->fore_3; ?></td>
									<td class="column4"><?php echo $r->fore_6; ?></td>
									<td class="column5"><?php echo $r->mad_3; ?></td>
									<td class="column6"><?php echo $r->mad_6; ?></td>
									<td class="column7"><?php echo $r->mse_3; ?></td>
									<td class="column8"><?php echo $r->mse_6; ?></td>
									<td class="column7"><?php echo $r->mape_3; ?></td>
									<td class="column8"><?php echo $r->mape_6; ?></td>
								</tr>
								<?php $i++ ?>
							<?php } ?>

						</tbody>
					</table>
				</div>

				<?php } ?>

					<div class="nengah">
						<form action="" method="post">
							<input id="demo" type="hidden" name="inputData" value=""></input>
							<button class="purple-bg" name="input" onclick="showPrompt()">Input Data</button>
							<button class="purple-bg" name="prediksi">Prediksi Bulan Depan</button>
						</form>
					</div>

				</div>
			</div>
		</div>



	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
