  <head>
    <meta charset="utf-8">
    <title>Here is our Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="SHJ Group">

    <!-- The styles -->
    <!--
	<link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	-->

	<!-- Include JavaScript -->
	<!--
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
	-->
	
	<script>
		$(document).ready(function() {
			
			// validate registerForm on keyup and submit
			$("#registerForm").validate({
				rules: {
					firstname: "required",
					lastname: "required",
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					}
				},
				messages: {
					firstname: "Please enter your firstname",
					lastname: "Please enter your lastname",
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: "Please enter a valid email address"
				}
			});
			
			// leaving this in for example on template for the ajax code.
			$('.increment').click(function()
			{
				//alert ('Hello!');
				
				var pr = ($('#totalPrice').text());
				var el = $(this).closest('tr').attr('id');
				$.ajax({url: 	'assets/inc/modCart.php',
						type: 	'POST',
						data: {	id : el, action : 'i' },
						success: function(data) {	
							var newVal = parseInt($('#' + el + 'qty').text()) + 1;
							$('#' + el + 'qty').text(newVal);	
							$('#' + el + 'price').text((newVal * parseFloat($('#' + el + 'ea').text())).toFixed(2));
							$('#totalPrice').text((parseFloat(pr) + parseFloat($('#' + el + 'ea').text())).toFixed(2));
							}
						});

			});
				
				
	
	
		});
		
		function display_alert()
		  {
		  alert("The Item has successfully been added to your Cart!");
		  }
		  
		function display_nouser()
			{
			alert("There is no matching username and password in the database");
			}
		
	</script>
	


	
  </head>
  <body>
	<p>
	This content is in the header
	</p>