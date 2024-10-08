<?php require "top.php";
if (isset($_SESSION['user_login']) && $_SESSION['user_login'] = 'yes') {
?>
	<script>
		window.location.href = 'my_order.php';
	</script>
<?php } ?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
							<a class="breadcrumb-item" href="index.php">Home</a>
							<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							<span class="breadcrumb-item active">Login</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="contact-form-wrap mt--60">
					<div class="col-xs-12">
						<div class="contact-title">
							<h2 class="title__line--6">Login</h2>
						</div>
					</div>
					<div class="col-xs-12">
						<form id="login-form" method="post">
							<div class=" single-contact-form">
								<div class="contact-box name">
									<input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
								</div>
								<span id="login_email_error" class="field_error"></span>
							</div>

							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
								</div>
								<span id="login_password_error" class="field_error"></span>
							</div>

							<div class="contact-btn">
								<button type="button" onclick="user_login()" class="fv-btn">Login</button>
							</div>
						</form>
						<div class="form-output login_msg">
							<p class="form-messege field_error"></p>
						</div>
					</div>
				</div>

			</div>


			<div class="col-md-6">
				<div class="contact-form-wrap mt--60">
					<div class="col-xs-12">
						<div class="contact-title">
							<h2 class="title__line--6">Register</h2>
						</div>
					</div>
					<div class="col-xs-12">
						<form id="register-form" method="post">
							<div class="registers-form single-contact-form">
								<div class="contact-box name">
									<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
								</div>
								<span id="name_error" class="field_error"></span>
							</div>
							<div class="single-contact-form registeration ">
								<div class="contact-box name">
									<input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
								</div>
								<span id="email_error" class="field_error"></span>
							</div>
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="text" name="mobile" id="mobile" placeholder="Your * Mobile " style="width:100%">
								</div>
								<span id="mobile_error" class="field_error"></span>
							</div>
							<div class="single-contact-form">
								<div class="contact-box name">
									<input type="text" name="password" id="password" placeholder="Your Password*" style="width:100%">
								</div>
								<span id="password_error" class="field_error"></span>
							</div>

							<div class="contact-btn">
								<button type="button" onclick="user_registeration()" class="fv-btn">Register</button>
							</div>
						</form>
						<div class="form-output register_msg ">
							<p class="form-messege field_error"></p>
						</div>
					</div>
				</div>

			</div>

		</div>
</section>


<?php require "footer.php"; ?>