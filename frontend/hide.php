<?php if (isset($_SESSION['id'])) { ?>
	<script type="text/javascript">
		
	$(document).ready(function(){

		$("li.log").hide();
		$("li.re").hide();
		$("li.log-out").show();
		$("li.acc").show();

		$("li.log-out").click(function(){		

	  	})

	})
	</script>
	
<?php } ?>

<?php if (empty($_SESSION['id'])) { ?>
	<script type="text/javascript">
		
		$(document).ready(function(){

			$("li.log").show();
			$("li.re").show();
			$("li.log-out").hide();
			$("li.acc").hide();

	})
	
	</script>
<?php } ?>
