<div class=" top-nav rsidebar span_1_of_left">
	<h3 class="cate">GENRE</h3>
		<ul class="menu">
			<?php 
			$menu = mysqli_query($conn, "SELECT * FROM tb_genre") or die(mysqli_error($conn));
			while($row = mysqli_fetch_assoc($menu)) { ?>
				<li>
					<ul class="kid-menu">
						<li><a href="product.php?id=<?= $row['id_genre']; ?>"><?= $row['nama_genre']; ?></a></li>
					</ul>
				</li>
			<?php } ?>
		</ul>
</div>
				<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
		<?php 
		$sidebarBrg = mysqli_query($conn, "SELECT * FROM tb_novel ORDER BY id_genre LIMIT 1") or die(mysqli_error($conn));
		while($row = mysqli_fetch_assoc($sidebarBrg)) { ?>
					<div class="chain-grid menu-chain">
	   		     		<a href="single.php?id=<?= $row['kd_novel']; ?>&rl=<?= $row['id_genre']; ?>"><img class="img-responsive chain" src="paneladmin/modul/produk/img/<?= $row['foto']; ?>" alt=" " /></a>	   		     		
	   		     		<div class="grid-chain-bottom chain-watch">
		   		     		<span class="actual dolor-left-grid">Rp. <?= number_format($row['hrg_jual'],2,",","."); ?></span>
		   		     		<span class="reducedfrom">Rp. 180.000,00</span>  
		   		     		<h6><a href="single.php?id=<?= $row['kd_novel']; ?>"><?= $row['nama']; ?></a></h6>  		     			   		     										
	   		     		</div>
	   		     	</div>
	   		     <?php } ?>
	   		     	 <a class="view-all all-product" href="product.html">VIEW ALL<span> </span></a> 	
			</div>
	   		    <div class="clearfix"> </div> 
