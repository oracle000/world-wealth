<html>
<head>
	<title>WorldWealth - Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<link rel="icon" href="<?php echo base_url(); ?>css/img/favico.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/homepage.css" />	
	<script type="text/javascript" src="<?php base_url(); ?>../js/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			var down = 0;
			var up = 0;
			$("#search").click(function(){
				reloadpyramid();
			});
			console.log($(window).width());
			$("body").on('keyup','#idno',function(e){
				if(e.keyCode == 13)
				{
					reloadpyramid();
					$(this).blur();
					$(".searchloader").css('visibility','hidden');
				}
				else if(e.keyCode == 40)
				{
					
					if(down == 0)
					{
						$("div#slreswrapper").removeClass('searchloaderhover');
						$("div#slreswrapper").first().addClass('searchloaderhover');
						$("#idno").val($("div#slreswrapper").first().children('span.slid').text().replace('- ',''));
						down = 1;
					}
					else
					{
						$(".searchloader").css('visibility','visible');
						var retval = 0;
						$("div#slreswrapper").each(function(f){
							//console.log($(this).attr("class"));
							if($(this).attr("class") == 'searchloaderhover'){
								if(retval == 0)
								{
									if($(this).is(':last-child') === false){
										$(this).removeClass('searchloaderhover');
										$(this).next().first().addClass('searchloaderhover');
										$("#idno").val($(this).next().first().children('span.slid').text().replace('- ',''));
										retval = 1;
									}
									else
									{
										$("div#slreswrapper").first().addClass('searchloaderhover');
										$("#idno").val($("div#slreswrapper").first().children('span.slid').text().replace('- ',''));
										$(this).removeClass('searchloaderhover');
										retval = 0;
									}
								}
								else
								{
									//return false;
								}
							}
						});
					}
				}
				else if(e.keyCode == 38)
				{
					
					var retval = 0;
					if(down == 0)
					{
						alert("true");
						$("div#slreswrapper").removeClass('searchloaderhover');
						$("div#slreswrapper").last().addClass('searchloaderhover');
						$("#idno").val($("div#slreswrapper").last().children('span.slid').text().replace('- ',''));
						down = 1;
					}
					else
					{
						$(".searchloader").css('visibility','visible');
						$("div#slreswrapper").each(function(f){
							if($(this).attr("class") == 'searchloaderhover'){
								if(retval == 0)
								{
									if($(this).is(':first-child') === false){
										$(this).prev().last().addClass('searchloaderhover');
										$("#idno").val($(this).prev().first().children('span.slid').text().replace('- ',''));
										$(this).removeClass('searchloaderhover');
										//alert("nagtrigger sa false");
										
									}
									else
									{
										//alert("trigger sa true");
										$("div#slreswrapper").removeClass('searchloaderhover');
										$("div#slreswrapper").last().addClass('searchloaderhover');
										$("#idno").val($("div#slreswrapper").last().children('span.slid').text().replace('- ',''));
										retval = 1;
									}
								}
								else
								{
									//alert("nagtrigger sa else");
									//return false;
								}
							}
						});
					}
				}
				else
				{
					$(".searchloader").css('visibility','visible');
					$.ajax({
						url:"<?php echo base_url(); ?>portal/searchusers",
						type:"POST",
						data:{search:$(this).val()},
						success:function(f){
							down = 0;
							$("div.slwrapper").html(f);
						}
					});
				}
			});
			$("#idno").focus(function(){
				down = 0;
				$(this).val("");
				
			});
			$("#idno").focusout(function(){
				if($(this).val() == "" || $(this).val() == " "){
					$(this).val("<?php echo $PK; ?>");
					$(".searchloader").css('visibility','hidden');
				}
			});
			function reloadpyramid()
			{
				var idno = $("#idno").val();
				var hasclass = 0;
				if(idno == '' || idno == null)
				{
					$("div#slreswrapper").each(function(){
						if($(this).hasClass('searchloaderhover') == true){
							var str = $(this).children('span.slid').text();
							search = str.replace('- ','');
							hasclass = 1;
						}
					});
					
					if(hasclass == 0)
					{
						search = '<?php echo $PK; ?>';
						$("#idno").val(search);
						hasclass= 0;
					}
					else
					{
						$("#idno").val(search);
						hasclass= 0;
					}
					
					
				}
				else
				{
					search = idno;
				}
				$.ajax({
					url:"<?php echo base_url(); ?>portal/pyramidview",
					type:"GET",
					data:{PK:search},
					success:function(e){
						$("#pyramidwrapper").html(e);
						if($(window).width() <= 1344)
						{
							$(".second:last-child").remove();
							
							if($(window).width() <= 1019)
							{
								$(".second:nth-last-child(2)").remove();
							}
						}
						width();
					}
				});
			}
			function width()
			{
				var count=1;
				var width = 0;
				$(" .tree ul li li").each(function(f){
					count++;
					width = 68 * count;
					//console.log(width);
					$('#wrapperpyramid').width($('#wrapperpyramid').width() + count);
					$('#pyramidwrapper').width($('#pyramidwrapper').width() + count);
					//console.log(width);
				});
				$('#wrapperpyramid').width(width);
				$('#pyramidwrapper').width(width);
				//alert(width);
			}
			reloadpyramid();
			var errors = <?php 
				if(isset($errors))
				{
					if($errors != "" && validation_errors() !== false)
					{
						
						$errors = validation_errors()."".$errors;
						$errors = json_encode($errors);
						echo $errors;
					}
					else
					{
						echo json_encode(validation_errors());
					}
				}
				else
				{
					if( validation_errors() !== false) echo json_encode(validation_errors()); 
				}
			?>;
			if(errors != "")
			{
				alert(errors);
			}
			$("body").on('click','#reloadpyramid',function(){
				var id = $(this).attr("ref");
				if(id != '----')
				{
					$("#loadingwrap").css('visibility','visible');
					setTimeout(function(){ 
						$("#loadingwrap").css('visibility','hidden'); 
						$("#idno").val(id);
						reloadpyramid();
					}, 3000);
					
				}
			});
			$(".tabcom").click(function(){
				$("div.rcreg").css('display','none');
				$("div.rccomm").css('display','block');
			});
			$(".tabreg").click(function(){
				$("div.rcreg").css('display','block');
				$("div.rccomm").css('display','none');
			});
			var cashamount = $(".cashamount").text();
			$("#forexconvert").change(function(){
				$("#encashamount").val("");
				$.ajax({
					url:"<?php echo base_url(); ?>portal/converterapi",
					type:"POST",
					data:{amount:cashamount,forexcode:$(this).val()},
					beforeSend:function(e){
						$("#encashbtn").prop("disabled",true);
						$("#encashbtn").addClass("disable");
					},
					success:function(e){
						$(".cashamount").html(e);
						$("#encashbtn").prop("disabled",false);
						$("#encashbtn").removeClass("disable");
					}
				});
			});
			$("#encashbtn").click(function(){
				var str = $(".cashamount").text();
				var result =  parseFloat(str.replace(',',''));
				var amount =  parseFloat($("#encashamount").val());
				if(amount <= result && $.isNumeric(amount) == true && amount != '0' && amount != '0.00')
				{
					$.ajax({
						url:"<?php echo base_url(); ?>portal/encashments",
						type:"POST",
						data:{
							amount:amount,
							forextype:$("#forextype").val(),
							forexcode:$("#forexconvert").val()
						},
						beforeSend:function(e){
							$("#encashbtn").prop("disabled",true);
							$("#encashbtn").addClass("disable");
						},
						success:function(e){
							$("#encashbtn").prop("disabled",false);
							$("#encashbtn").removeClass("disable");
							if(e == 1){
								window.location = document.URL;
							}
						}
					});
				}
				else
				{
					alert("Double Check Your Inputs!");
				}
			});
			$('body').on('click',"#addbankaccount",function(){
				$("#formupdate .additional").append("<div class='inputwrapper'><div class='lblinput'></div><div class='lbltxtfld2'><input type='text' name='bankname[]' value='Name' id='bankname' /><input type='text' name='accountno[]' value='Account No'  id='accountno' /></div><div class='lbltxtfld3'><div style='width:20px;display:inline-block;float:right'><img title = 'Delete Bank Account Details' id='deletebankaccount' src='<?php echo base_url(); ?>css/img/crossico.png' style='height:20px'></div><div style='width:20px;display:inline-block;float:left'><img title = 'Add Bank Account Details' id='addbankaccount' src='<?php echo base_url(); ?>css/img/addico.png' style='height:20px'></div></div></div>");
			});
			
			$('body').on('click',"img#deletebankaccount",function(){
				$(this).parent("div").parents("div.inputwrapper").remove();
				//$("#testingkoto.inputwrapper").remove();
			});
			$(window).resize(function(){
				reloadpyramid();
			});		
		});
	</script>
</head>
<body>
	<div id="loadingwrap"></div>
	<div id="container">
		<div id="header">
			<div id="tophdr"><a href="<?php echo base_url(); ?>portal/homepage"><img class="wwicon" src="<?php echo base_url(); ?>css/img/wwicon2.jpg" height=50px title="Homepage World Wealth"></a></div>
			<div id="bothrd">
				<div id="bothdrcontainer">
					<div id="usermod">
						<a href="<?php echo base_url(); ?>portal/homepage">
						<div class="imgcon"><img id="imghdrlinks" height=40px src="<?php echo base_url(); ?>css/img/userpic<?php echo $profiledir; ?>.png"></div>
						<div class="hdrlinks" <?php if($profiledir != '') echo "style=\"color:#024972;\""; ?>>Profile</div>
						</a>
					</div>
					<div id="walletmod">
						<a href="<?php echo base_url(); ?>portal/wallet">
						<div class="imgcon"><img id="imghdrlinks" height=40px src="<?php echo base_url(); ?>css/img/wallet<?php echo $walletdir; ?>.png"></div>
						<div class="hdrlinks" <?php if($walletdir != '') echo "style=\"color:#024972;\""; ?>>Wallet</div>
						</a>
					</div>
					<div id="transactionmod">
						<a href="<?php echo base_url(); ?>portal/transaction">
						<div class="imgcon"><img id="imghdrlinkstrx" height=40px src="<?php echo base_url(); ?>css/img/transaction<?php echo $trxdir; ?>.png"></div>
						<div class="hdrlinks" <?php if($trxdir != '') echo "style=\"color:#024972;\""; ?>>Genealogy</div>
						</a>
					</div>
					<div id="incentivesmod">
						<div class="imgcon"><img id="imghdrlinkstrx" height=40px src="<?php echo base_url(); ?>css/img/incentives<?php echo $incentivesdir; ?>.png"></div>
						<div class="hdrlinks" <?php if($incentivesdir != '') echo "style=\"color:#024972;\""; ?>>Incentives</div>
					</div>
					<div id="logoutmod">
						<a href="<?php echo base_url(); ?>portal/logout">
						<div class="imgcon"><img id="imghdrlinks" height=40px src="<?php echo base_url(); ?>css/img/logout.png"></div>
						<div class="hdrlinks">Logout</div>
						</a>
					</div>
					
				</div>
			</div>
		</div>
		
