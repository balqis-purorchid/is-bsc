<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mengisi Scorecard</title>
	<link rel="stylesheet" href="http://localhost/is-bsc/assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="http://localhost/is-evaluation/assets/css/custom.css"/>
	<script src="http://localhost/is-bsc/assets/jQuery/jquery-3.3.1.min.js"></script>
	<script src="http://localhost/is-bsc/assets/js/bootstrap.min.js"></script>

</head>
<body>    
	<div class="container">
		<form action="<?php echo base_url();?>instrument/pengisian" method="post">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-transparent">
						<div class="panel-heading">
							<h2 class="panel-title" style="color: white;">Jenis Kontribusi</h2>
						</div>
						<div class="panel-body">
							<p>Pada bagian mana Anda bekerja/berkontribusi dalam organisasi ini?</p>
							<input type="radio" name="tipe" value="IT" required="required">
							<label for="IT">IT</label>
							<br>
							<input type="radio" name="tipe" value="non-IT">
							<label for="non-IT">Non-IT</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-transparent">
						<div class="panel-heading">
							<h2 class="panel-title" style="color: white;">Instrumen Penilaian</h2>
						</div>
						<div class="panel-body">
							<p>Mohon memberi pendapat terhadap seluruh pernyataan di bawah dengan memilih salah satu dari 5 opsi yang tersedia.</p>
							<table class="table" role="table">
								<thead role="rowgroup">
									<tr role="row">
										<th role="columnheader">Nomor</th>
										<th role="columnheader">Pernyataan</th>
										<th role="columnheader" colspan="5">Jawaban</th>
									</tr>
								</thead>
								<tbody role="rowgroup">
								<?php
								$num = 1;//counter kolom nomor
								foreach ($instrumen as $row) { 
									$i = 1;//counter jawaban
								?>
								<tr role="row">
									<td role="cell"><?php echo $num; $num++; ?></td>
									<td role="cell">
										<?php echo $row->teks_instrumen; ?>
									</td>
									<td role="cell">
										<input type="radio" name="instrumen[<?php echo $row->id_pakai_instrumen; ?>]" value="<?php echo $i; $i++; ?>" required>
										<?php echo $row->teks_skala1; ?>
									</td>
									<td role="cell">
										<input type="radio" name="instrumen[<?php echo $row->id_pakai_instrumen; ?>]" value="<?php echo $i; $i++; ?>">
										<?php echo $row->teks_skala2; ?>
									</td>
									<td role="cell">
										<input type="radio" name="instrumen[<?php echo $row->id_pakai_instrumen; ?>]" value="<?php echo $i; $i++; ?>">
										<?php echo $row->teks_skala3; ?>
									</td>
									<td role="cell">
										<input type="radio" name="instrumen[<?php echo $row->id_pakai_instrumen; ?>]" value="<?php echo $i; $i++; ?>">
										<?php echo $row->teks_skala4; ?>
									</td>
									<td role="cell">
										<input type="radio" name="instrumen[<?php echo $row->id_pakai_instrumen; ?>]" value="<?php echo $i; ?>">
										<?php echo $row->teks_skala5; ?>
									</td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
							<br>
							<p>Dengan menekan tombol Simpan, jawaban Anda akan tersimpan dan Anda akan otomatis log-out dari akun responden ini.</p>
							<input type='Submit' class="btn btn-default" value='Simpan' />
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<style type="text/css">
		/*
		Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
		*/
		@media
		  only screen 
	    and (max-width: 760px), (min-device-width: 768px) 
	    and (max-device-width: 1024px)  {

			/* Force table to not be like tables anymore */
			table, thead, tbody, th, td, tr {
				display: block;
			}

			/* Hide table headers (but not display: none;, for accessibility) */
			thead tr {
				position: absolute;
				top: -9999px;
				left: -9999px;
			}

	    tr {
	      margin: 0 0 1rem 0;
	    }
	      
	    tr:nth-child(odd) {
	      background: #ccc;
	    }
	    
			td {
				/* Behave  like a "row" */
				border: none;
				border-bottom: 1px solid #eee;
				position: relative;
				padding-left: 50%;
			}

			td:before {
				/* Now like a table header */
				position: absolute;
				/* Top/left values mimic padding */
				top: 0;
				left: 6px;
				width: 45%;
				padding-right: 10px;
				white-space: nowrap;
			}

			/*
			Label the data
	    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
			*/
			/*td:nth-of-type(1):before { content: "Nomor"; }
			td:nth-of-type(2):before { content: "Pernyataan"; }
			td:nth-of-type(3):before { content: "Jawaban"; }*/
		}
	</style>
</body>
</html>