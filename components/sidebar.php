<nav id="sidebar">
	<div class="custom-menu">
		<button type="button" id="sidebarCollapse" class="btn btn-primary">
	        <i class="fa fa-bars"></i>
	        <span class="sr-only">Toggle Menu</span>
	    </button>
    </div>
	<div class="p-4">
		<h1><a href="index.html" class="logo">B&B Fornitures <span>Forniture Dashboard</span></a></h1>
	    <ul class="list-unstyled components mb-5">
	        <li class="active">
	            <a href="/corso/"><span class="fa fa-home mr-3"></span> Home</a>
	        </li>
	        <li>
	            <a href="/corso/fornitori/"><span class="fa fa-user mr-3"></span> Fornitori</a>
	        </li>
	        <li>
                <a href="#"><span class="fa fa-briefcase mr-3"></span> Log Errori</a>
	        </li>
			<li>
                <a href="#"><span class="fa fa-briefcase mr-3"></span> Log Operazioni</a>
	        </li>
			<?php
				if(isset($_SESSION['ruolo'])){
					if($_SESSION['ruolo']=='admin'){
						echo("<li><a href='#'><span class='fa fa-suitcase mr-3'></span> Utenti</a></li>");
					}
				}
			?>
	        
	        <li>
                <a href="#"><span class="fa fa-cogs mr-3"></span> Profilo</a>
	        </li>
	    </ul>
	    

	    <div class="footer">
	        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | B&B Meccanica.snc</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	    </div>
	</div>
</nav>