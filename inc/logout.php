<?php
	session_start();
	
	//end the session[user]
	$_SESSION['user'] = null;
?>	
	<script type="text/javascript">
	history.back();
	</script>

