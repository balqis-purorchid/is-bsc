<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home: <?php echo $this->session->userdata('bscid');?></title>
	<link rel="stylesheet" href="http://localhost/is-bsc/assets/css/bootstrap.min.css"/>
	<script src="http://localhost/is-bsc/assets/jQuery/jquery-3.3.1.min.js"></script>
	<script src="http://localhost/is-bsc/assets/js/bootstrap.min.js"></script>

</head>
<body>    
	
	
	<div class="container">
		<form action="<?php echo base_url();?>instrument/pengisian" method="post">
			<table border="1">
				<?php 
				$nilai = 0;
				$name = 0;//counter form name instrumen
				foreach ($instrumen as $row) { 
					$i = 1;//counter jawaban
					$name++;
				?>
				<tr>
					<td width="100">
						<?php echo $row->teks_instrumen; ?>
					</td>
					
					<?php 
					if($row->tipe_jawaban == "skala") { ?>
						<td width="10%">
							<input type="radio" name="instrumen<?php echo $name; ?>" value="<?php echo $i; $i++; ?>">
							<?php echo $row->teks_skala1; ?>
						</td>
						<td width="10%">
							<input type="radio" name="instrumen<?php echo $name; ?>" value="<?php echo $i; $i++; ?>">
							<?php echo $row->teks_skala2; ?>
						</td>
						<td width="10%">
							<input type="radio" name="instrumen<?php echo $name; ?>" value="<?php echo $i; $i++; ?>">
							<?php echo $row->teks_skala3; ?>
						</td>
						<td width="10%">
							<input type="radio" name="instrumen<?php echo $name; ?>" value="<?php echo $i; $i++; ?>">
							<?php echo $row->teks_skala4; ?>
						</td>
						<td width="10%">
							<input type="radio" name="instrumen<?php echo $name; ?>" value="<?php echo $i; ?>">
							<?php echo $row->teks_skala5; ?>
						</td>
						
						
					<?php } else if($row->tipe_jawaban == "yt") {?>
						<td>
							<?php echo "Ya"; ?>
						</td>
						<td>
							<?php echo "Tidak"; ?>
						</td>
					<?php } ?>
				</tr>
				<?php
				}
				// echo $_POST['instrumen1'];
				// echo $_POST['instrumen2'];
				// echo $_POST['instrumen3'];
				?>
			</table>
			<input type='Submit' class="btn btn-default" value='Simpan' />
		</form>
		</div>
	
	</body>
</html>