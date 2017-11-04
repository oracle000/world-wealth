<html>
<title>View Pyramid</title>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/pyramid.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript">
	
		$( document ).ready( function( ) {
				var count = 1;
				var counter = 1;
				var parent = "<?php echo $this->input->get("PK",FALSE); ?>";
				var laststring = "";
				$(window).scrollLeft(0);
				$('body').on('click',"div#lblresult",function(){
					$("#loader").show();
					var string = $(this).attr("ref");
					if(string != laststring)
					{	
						var test = "idcounter";
						$( '.tree li' ).each( function() {
							if($(this).children('ul').length > 0)
							{
								if($(this).attr("value") == parent && $(this).attr('class') == 'parent active' )
								{
									$( this ).toggleClass( 'active' );
									$( this ).children( 'ul' ).slideToggle( 'fast' );
								}
								else if($(this).attr('class') != 'parent active' && $(this).attr("value") != parent)
								{
									$( this ).toggleClass( 'active' );
									$( this ).children( 'ul' ).slideToggle( 'fast' );
								}
								console.log($(this).attr("ref"));
							}
						});
						$("li a:contains("+laststring+")").css('background-color','none')
					
						if($("li a:contains("+string+")").length > 0)
						{
							var $obj = $("li a:contains("+string+")").parents('li');
							$('li').removeAttr("refer");
							$obj.each(function(){
								$( this ).attr( 'refer',""+test+count+"" );
							});
							
							$( ".tree li[refer]").each( function() {
								if($(this).attr("value") != parent)
								{
									$( this ).children( 'ul' ).slideToggle( 'slow' );
									$(this).toggleClass('active');
								}
								
							$("li a:contains("+string+")").css('background-color','yellow');
								
							});
							
							laststring = string;
							count++;
							counter++;
							var halfwidth = $(window).width() / 2;
							//var halfheight = $(window).height() / 2;
							var scrollleft = $("li a:contains("+string+")").offset().left - halfwidth ;
							var scrolltop = $("li a:contains("+string+")").offset().top ;
						}
						else
						{
							alert("No Member with Name: "+string+ " Found" );
						}
					}
					
					
					setTimeout(function()
					{
						$("#loader").hide();
						$(window).animate({scrollLeft:scrollleft},800);
						$(window).animate({scrollTop:scrolltop},800);
					},3000);
				});
				$( '.tree li' ).each( function() {
						if( $( this ).children( 'ul' ).length > 0 ) {
								$( this ).addClass( 'parent' );     
						}
				});
				$( '.tree li.parent > a' ).click( function( ) {
						$( this ).parent().toggleClass( 'active' );
						$( this ).parent().children( 'ul' ).slideToggle( 'fast' );
						$('body').width($('body').width() + 300);
				});
				
				$( '#testingkoto' ).click( function() {
					$( '.tree li' ).each( function() {
						$( this ).toggleClass( 'active' );
						$( this ).children( 'ul' ).slideToggle( 'fast' );
					});
				});
				
				$( '.tree li > ul li' ).each( function() {
						//console.log($(this).attr("ref"));
						$( this ).toggleClass( 'active' );
						$( this ).children( 'ul' ).slideToggle( 'fast' );
						
				});
				
				var count = 1;
				function width()
				{
					var width = 0;
					$(".tree ul").each(function(f){
						count++;
						width = 360 * count;
						$('body').width($('body').width() + count);
						//console.log(width);
					});
					$('body').width(width);
				}
				width();
				/*
				
				$('li a:contains(10000000450)').css('background-color','yellow');
				$("li:contains(10000000450):parent > ul li:parent").addClass('active');
				$("li:contains(10000000450):parent > ul li:parent").children('ul').slideToggle('fast');
				alert($("li ul a:contains(10000000450)").text());
				*/
				
				$("#loader").css("width",$(window).width());
				/*
				$( '.tree li:not(.testing)' ).each( function() {
					$( this ).toggleClass( 'active' );
						//$( this ).css( 'font-weight','bold' );
					$( this ).children( 'ul' ).slideToggle( 'fast' );
					$('body').width($('body').width() + 360)
				});
				*/
				
				setTimeout(function(){
					$("#loader").hide();
				},3000);
				
				$("#menu").click(function(){
					$("#leftwrapper").animate({left:'-298px'},"slow");
				});
				$("#leftwrapper").hover(function(){
					$("#leftwrapper").animate({left:'0px'},"slow");
				},3000);
				$("#find").keyup(function(){
					var keywords = $(this).val();
					$.ajax({
						data:{'keywords':keywords},
						url:"<?php echo base_url(); ?>home/search",
						type:"POST",
						success:function(e){
							if(keywords.length > 0)
							{
								$("#lblresult:first-child").css('border-top','1px solid white');
								//$("#lblresult:last-child").css('border-bottom','1px solid white');
								$("#keywordslbl").html("Keywords: <i>"+keywords+"</li>");
								$("#result").html(e);
								//alert(e);
							}
							else
							{
								$("#lblresult:first-child").css('border-top','none');
								//$("#lblresult:last-child").css('border-bottom','none');
								$("#keywordslbl").html("&nbsp;");
								$("#result").html("");
							}
						}
					});
				});
				
		});
	
</script>
</head>
<body>

<div id="pyramidview"><?php print_r($test); ?></div>

<div id="leftwrapper">
	<div id="searchcontainer">
	<div id="menuwrapper">
	<div id="menu"></div>
	<div id="menulbl">World Wealth - Search</div>
	</div>
	<div id="searchwrapper">
		<div class="searchfld"><?php echo form_input('find','','id="find"'); ?></div>
		<div class="searchfldimg"></div>
	</div>
	</div>
	<div id="keywordslbl"></div>
	<div id="result">
		
	</div>
	
</div>
<div id="loader">
	<div id="wrapper"></div>
</div>

</div>
</body>
</html>