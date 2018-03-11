<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<title></title>
<head>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryui.js"></script>
	<script type="text/javascript">
			
		$(document).ready(function(){
			
			$(window).scroll(function (event) {
				var scroll = $(window).scrollTop();
				var height = $(window).height();
				
				function scrollzero()
				{
					$("#missionvission").show();
					$("#headerwrap").css("height","150px");
					$("#header").css("height","150px");
					$("#headerwrap" ).css({"color":"#FFFFFF","height": "150px","border-bottom":"1px solid white"});
					$("#headerwrap").css("color","#FFFFFF");
					$("#headerwrap").css("border-bottom","1px solid #FFFFFF");
					$("#header" ).css({"background-color":"#5b6169","height":"150px","opacity":"0.5"});
					$("#header").css("background-color","#5b6169");
					$("#header").css("opacity","0.5");
					$("#content").css("margin-top","150px");
					$("head").append($('<style>div#content:after { margin-top:150px;opacity:0.5 }</style>'));
					$(".webnamewrap" ).css("margin-top","30px");
					$(".hdrlinkswrap").css("margin-top","62");
					//$(".webname").css("border","5px solid #FFFFFF");
					$("#complogo").animate({height:"100px"});
					$("#complogo").attr("src","<?php echo base_url(); ?>/css/img/companylogowhite.png");
				}
				function scrollsecond()
				{
					$( "#headerwrap" ).animate({color: "#000000",height: 100,border:0}, 500 );
					$( "#header" ).animate({backgroundColor: "#ffffff",height:100,opacity:1}, 500 );
					$( ".webnamewrap" ).animate({marginTop:20}, 500 );
					$(".hdrlinkswrap").animate({marginTop:40}, 500 );
					$("#content").css("margin-top","100px");
					$("head").append($('<style>div#content:after { margin-top:100px; }</style>'));
					$(".webname").animate({	borderTopColor:"#000000",borderBottomColor:"#000000",borderRightColor:"#000000",borderLeftColor:"#000000"}, 500 );
					$("#missionvission").hide();
					$("head").append($('<style>div#content:after { opacity:0.5 }</style>'));
					$("#complogo").animate({height:"70px"});
					$("#complogo").attr("src","<?php echo base_url(); ?>/css/img/companylogo2.png");
				}
				function scrollthird()
				{
					$( "#headerwrap" ).animate({color: "#000000",height: 100,border:0}, 500 );
					$( "#header" ).animate({backgroundColor: "#ffffff",height:100,opacity:1}, 500 );
					$( ".webnamewrap" ).animate({marginTop:20}, 500 );
					$(".hdrlinkswrap").animate({marginTop:40}, 500 );
					$("#content").css("margin-top","100px");
					$("head").append($('<style>div#content:after { margin-top:100px; }</style>'));
					//$(".webname").animate({	borderTopColor:"#000000",borderBottomColor:"#000000",borderRightColor:"#000000",borderLeftColor:"#000000"}, 500 );
					$("head").append($('<style>div#content:after { opacity:0 }</style>'));
					$("#missionvission").hide();
					$("#complogo").animate({height:"70px"});
					$("#complogo").attr("src","<?php echo base_url(); ?>/css/img/companylogo2.png");
				}
				function scrollfourth()
				{
					$("#missionvission").hide();
					$("#headerwrap").css("height","150px");
					$("#header").css("height","150px");
					$("#headerwrap" ).css({"color":"#FFFFFF","height": "150px","border-bottom":"1px solid white"});
					$("#headerwrap").css("color","#FFFFFF");
					$("#headerwrap").css("border-bottom","1px solid #FFFFFF");
					$("#header" ).css({"background-color":"#5b6169","height":"150px","opacity":"0.5"});
					$("#header").css("background-color","#5b6169");
					$("#header").css("opacity","0.5");
					$("#content").css("margin-top","150px");
					$("head").append($('<style>div#content:after { margin-top:150px;opacity:0.5 }</style>'));
					$(".webnamewrap" ).css("margin-top","30px");
					$(".hdrlinkswrap").css("margin-top","62");
					//$(".webname").css("border","5px solid #FFFFFF");
					$("#complogo").animate({height:"100px"});
					$("#complogo").attr("src","<?php echo base_url(); ?>/css/img/companylogowhite.png");
				}
				//$(".home").html(scroll);
			
				clearTimeout($.data(this, 'scrollTimer'));
				$.data(this, 'scrollTimer', setTimeout(function() {
					if(scroll >= 200 && scroll <= 620)
					{
						scrollsecond();
					}
					else if(scroll >= 0 && scroll < 200)
					{
						scrollzero();
					}
					else if(scroll >= 666 && scroll < 1300)
					{
						$( "#headerwrap" ).animate({color: "#000000",height: 100,border:0}, 500 );
						$( "#header" ).animate({backgroundColor: "#ffffff",height:100,opacity:1}, 500 );
						$( ".webnamewrap" ).animate({marginTop:20}, 500 );
						$(".hdrlinkswrap").animate({marginTop:40}, 500 );
						$("#content").css("margin-top","100px");
						//$("head").append($('<style>div#content:after { margin-top:100px; }</style>'));
						//$(".webname").animate({	borderTopColor:"#000000",borderBottomColor:"#000000",borderRightColor:"#000000",borderLeftColor:"#000000"}, 500 );
						$("#missionvission").hide();
						$("head").append($('<style>div#content:after { opacity:0 }</style>'));
						$("#complogo").animate({height:"70px"});
						$("#complogo").attr("src","<?php echo base_url(); ?>/css/img/companylogo2.png");
					}
					else if(scroll >= 1300 && scroll < 2000)
					{
						scrollfourth();
					}
					else if(scroll >= 2000)
					{
						$( "#headerwrap" ).animate({color: "#000000",height: 100,border:0}, 500 );
						$( "#header" ).animate({backgroundColor: "#ffffff",height:100,opacity:1}, 500 );
						$( ".webnamewrap" ).animate({marginTop:20}, 500 );
						$(".hdrlinkswrap").animate({marginTop:40}, 500 );
						$("#content").css("margin-top","100px");
						$("head").append($('<style>div#content:after { margin-top:100px; }</style>'));
						//$(".webname").animate({	borderTopColor:"#000000",borderBottomColor:"#000000",borderRightColor:"#000000",borderLeftColor:"#000000"}, 500 );
						$("#missionvission").hide();
						$("head").append($('<style>div#content:after { opacity:0 }</style>'));
						$("#complogo").animate({height:"70px"});
						$("#complogo").attr("src","<?php echo base_url(); ?>/css/img/companylogo2.png");
					}
				}, 500));
				
			});
		
			$(".aboutus").click(function(){
				$("html,body").animate({scrollTop: 620}, 1000);
			});
			$(".home").click(function(){
				$("html,body").animate({scrollTop: 0}, 1000);
			});
			$(".login").click(function(){
				$("html,body").animate({scrollTop: 1348}, 1000);
			});
			$(".contactus").click(function(){
				$("html,body").animate({scrollTop: 2130}, 1000);
			});
			var url = "<?php if(isset($_GET['style'])) echo $_GET['style']; ELSE echo ''; ?>";
			if(url == "aboutus")
			{
				$("html,body").animate({scrollTop: 620}, 1000);
			}
			else if(url == "contactus")
			{
				$("html,body").animate({scrollTop: 2130}, 1000);
			}
			else if(url == "login")
			{
				$("html,body").animate({scrollTop: 1348}, 1000);
			}
			
			$("#username").focus(function()
			{
				var username = $("#username").val();
				if(username == 'Usercode')
				{
					$("#username").val("");
				}
			});
			$("#fakepassword").focus(function()
			{
				$("#fakepassword").hide();
				$("#password").show();
				$("#password").focus();
			});
			$("#username").focusout(function()
			{
				var username = $("#username").val();
				if(username == "" || username == NULL)
				{
					$("#username").val("Usercode");
				}
			});
			$("#password").focusout(function()
			{
				var password = $("#password").val();
				if(password == "" || password == NULL)
				{
					$("#password").hide();
					$("#fakepassword").show();
				}
			});
			var check = "<?php if(isset($loginattemp) == 1) echo $loginattemp; else "0"; ?>";
			if(check == "1")
			{
				$("html,body").animate({scrollTop: 1348}, 1000);
				$("#fakepassword").focus();
			}
		});
	</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="headerwrap">
				<div class="webnamewrap">
					<div class="webname"><img src="<?php echo base_url(); ?>css/img/companylogowhite.png" height="100px" id="complogo"></div>
				</div>
				<div class="headerlinks">
					<div class="hdrlinkswrap">
						<div class="home">HOME</div>
						<div class="aboutus">ABOUT US</div>
						<div class="contactus">CONTACT US</div>
						<div class="login">LOGIN</div>
					</div>
				</div>
			</div>
		</div>
		<div id="content">
			<div id="missionvission">
				<div class="mvwrap">
				We empower <br />
				<strong>visionaries</strong><br />
				to lead <br />	
				<strong>meaningful<br /> 
				brands.</strong><br />
				</div>
			</div>
		</div>
		<div id="parallaxcon">
		
		<div id="aboutuswrap">
			<div id="aboutuscon">
				<div id="aboutusleft">
					<div class="topline"></div>
					<div class="aboutuslbl">Who We<br/>Are ?</div>
				</div>
				<div id="aboutusright">
					<div class="topmargin">&nbsp;</div>
					<div class="descwrapper">
						<div class="topdescwrap"> 
							<div class="topleftdesc">
								<div class="rightborder"></div>
								<div class="topdesc">
									<font size="6">Enlightened<br/>Entrepreneurs<br/></font>
									<font face="arial" size="3"><i><br/><b>For more than profit.</b><br /><br /></i></font>
									<label class="wwadesc">Organizations that have a conscience; the notion that doing right by others outweighs the bottom line.</label>
								</div>
							</div>
							<div class="toprightdesc">
								<div class="rightborder"></div>
								<div class="topdesc">
									<font size="6">Heroes & Heroines<br/></font>
									<font face="arial" size="3"><i><br/><b>We love do-gooders.</b><br /><br /></i></font>
									<label class="wwadesc">People who live in the trenches, bend their backs, raise funds, and dirty their hands with the problems of others.</label>
								</div>
							</div>
						</div>
						<div class="botdescwrap">
							<div class="topleftdesc">
								<br/>
								<div class="rightborder"></div>
								<div class="topdesc">
									<font size="6">Enlightened<br/>Entrepreneurs<br/></font>
									<font face="arial" size="3"><i><br/><b>For more than profit.</b><br /><br /></i></font>
									<label class="wwadesc">Organizations that have a conscience; the notion that doing right by others outweighs the bottom line.</label>
								</div>
							</div>
							<div class="toprightdesc">
								<div class="rightborder"></div>
								<div class="topdesc">
									<font size="6">Heroes & Heroines<br/></font>
									<font face="arial" size="3"><i><br/><b>We love do-gooders.</b><br /><br /></i></font>
									<label class="wwadesc">People who live in the trenches, bend their backs, raise funds, and dirty their hands with the problems of others.</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="logincon">
			<div id="loginwrap">
				<div id="loginfld">
					<div id="loginleft">LOGIN</div>
					<div id="loginright">
						<div id="logindtlswrap">
							<div class="usernamewrap">
								<?php echo form_open("task/checklogin"); ?>
								<?php echo form_input("username", set_value("username"), "id=\"username\""); ?>
							</div>
							<div class="passwordwrap"><?php echo form_input("fakepassword","Password","id=\"fakepassword\""); ?><?php echo form_password("password", "", "id=\"password\""); ?></div>
							<div class="buttonwrap"><?php echo form_submit('login',"Login","id=\"login\"")?></div>
							<div class="signup">Don't have an account?  <?php echo anchor("task/register","Sign up here","title=\"Home\""); ?></div>
							<div class="forgot">Forgot your password?</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="allsocialnet">
			<div id="followuswrap">
				<div id="connectwithus">
					<div class="connectwrapper">
						<div class="line"></div>
						<div class="lblconnect">FOLLOW US</div>
						<div class="line"></div>
					</div>
				</div>
			</div>
			<div id="socialnetwrap">
				<div class="socialnetcon">
					<div class="facebooklogo"><img src="<?php echo base_url();?>css/img/fbico.png" width="100px" /></div>
					<div class="twitterlogo"><img src="<?php echo base_url();?>css/img/twitterico.png" width="100px" /></div>
					<div class="linkedinlogo"><img src="<?php echo base_url();?>css/img/linkedinico.png" width="100px" /></div>
				</div>
				<div class="socialnetdtlscon">
					<div class="dtls">
						<b><font color="#739ccd">FACEBOOK</font></b><br/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas egestas interdum fringilla.
					</div>
					<div class="dtls">
						<b><font color="#739ccd">TWITTER</font></b><br/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas egestas interdum fringilla.
					</div>
					<div class="dtls">
						<b><font color="#739ccd">LINKEDIN</font></b><br/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas egestas interdum fringilla.
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>