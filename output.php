<div class="container-fluid">
	<div class="card shadow mb-4">
  		<div class="card-body">
			<br>
		<h3 class="ui header">Normalisasi</h3>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead class="table-dark" style="background-color: #548176">
						<tr>
							<th>Kriteria</th>
						<?php 
								for ($i=0; $i <= ($n-1); $i++) { 
									echo "<th>".getnamakriteria($i)."</th>";
								}
						?>
							<th>Jumlah</th>
							<th>Bobot</th>
						</tr>
					</thead>
				<tbody>
<?php 
	for ($x=0; $x <= ($n-1); $x++) { 
		echo "<tr>";
		echo "<td>".getnamakriteria($x)."</td>";
			for ($y=0; $y <= ($n-1); $y++) { 
				echo "<td>".round($matrikb[$x][$y],5)."</td>";

			}
			echo "<td>".round($jmlmk[$x],5)."</td>";
			echo "<td>".round($bbt[$x],5)."</td>";

			echo "<tr>";
	}
 ?>
	</tbody>
		<tfoot>
			<tr>
				<th colspan="<?php echo ($n+2)?>"> Lambda (eigen vektor) Maks</th>
				<th><?php echo (round($lamda,5))?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n+2)?>"> Indeks Konsistensi (CI)</th>
				<th><?php echo (round($konsistensiindex,5))?></th>
			</tr>			
			<tr>
				<th colspan="<?php echo($n+2)?>">Konsistensi Ratio</th>
				<th><?php echo (round(($konsistensiratio * 100),2))?> %</th>
			</tr>
		</tfoot>
	</table>
</div>

<?php  

if ($konsistensiratio > 0.1) {
	?>
		<div class="alert alert-danger" role="alert">
            <div class="header"> 
            	<i class="fas fa-exclamation-triangle"></i>Nilai <b><em>Consistency Ratio (CR) Lebih </em>dari 10%!!! </b>
                    Mohon input kembali tabel perbandingan.
            </div>
        </div>

				<br>

				<a href='javascript:history.back()'>
					<button class="btn btn-info float-left">
						<i class="fas fa-angle-double-left"></i> Kembali
					</button>
				</a>
				<?php 

		}else{

	?>
	<br>
	<div class="alert alert-success" role="alert">
        <div class="header"> <i class="fas fa-check-circle"></i> Nilai <b><em>Consistency Ratio</em></b> telah konsisten < 10%
        </div>
    </div>
<!--     <?php if ($nt>0):?>
    	<form action="perhitungan2.php">
        <button class="btn btn-info float-right"><i class="fas fa-angle-double-right"></i> Lanjut
        </button>
    </a>
    	<?php else: ?>

        <button class="btn btn-info float-right" onclick="return confirm ('Alternatif belum diinput nilai');" ><i class="fas fa-angle-double-right"></i> Lanjut</button>
    
    </a>

		</form>
    	<?php endif; ?> -->

	

	<a href='javascript:history.back()'>
		<button class="btn btn-info float-left">
			<i class="fas fa-angle-double-left"></i> Kembali
		</button>		
	</a>

	<?php
}
echo "</section>";
?>
</div>
	</div>
		</div>