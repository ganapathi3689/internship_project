<?php 
require("../dbconnection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Playfair+Display&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="header.css?v=7">
    <title>EDU-TECH</title>
</head>
<body>
	
	
    <!---start header---->
	<header>
		<a href="#" class="logo">
			<img src="img/edutech_logo.png">
		</a>
        <div class="search-container">
            <form action="" style="display: flex;width:190%">
              <input type="text" placeholder="Search..." name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
		<ul class="navbar">
            
			
			<li><a href="#categories">Categories</a></li>
			<li><a href="#courses">Courses</a></li>
			<li><a href="#about">About Us</a></li>
			<li><a href="#contact">Contact</a></li>
		</ul>

		<div class="header-icons">
			
			<a href="#"><i class="fa fa-heart-o" style="font-size:24px"></i></a>
			<a href="#"><i class="fa fa-bell-o" style="font-size:24px"></i></a>
			<a href="#"><i class="fa fa-cart-plus" style="font-size:24px"></i></a>&nbsp;
			<?php if(isset($_SESSION['loggedin'])){
				echo"
				<div class='dropdown1'>
                 <ul>
       
                  <li>
				  <a href='#'><i class='fa fa-user-circle-o' style='font-size:36px'></i></a>
                    <ul class='dropdown'>
                     <li><a href='#'><i class='fa fa-home'></i> Home</a></li>
                     <li><a href='#'><i class='fa fa-edit'></i> Edit</a></li>
          
                     <hr>
                     <li><a href='../logout.php'><i class='fa fa-sign-out'></i>Logout</a></li>
                    </ul>
                    </li>
      
               </ul>
             </div>";
			}
			else{
				echo "<a  id='login' class='login'>Login</a>
				&nbsp;&nbsp;
				<a  id='signup' class='signup'>Sign Up</a>";
			}
			?>
			

			<!-- <a href="#"><i class="fa fa-user-circle-o" style="font-size:36px"></i></a> -->
			<div class="bx bx-menu" id="menu-icon"></div>
		</div>
	</header>
	<!-- first section start -->
	<section class="home" id="home">
		<div class="home-text">
			<h6>Best online learning platform</h6>
			<h1>Accessible Online Courses For All</h1>
			<p>Own your future learning new skills online</p>
			<br>
			<div class="latter">
			<?php if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
				echo"<h2>Welcome back,&nbsp;&nbsp;$_SESSION[name]</h2>
				<br>
				<h6>
					Make today the day. Get courses from real-world experts from ₹499.
				</h6>";
			}
			else{
				echo "<h2>Welcome ,Please Login </h2>
				<br>
				<h6>
					Login Now ,To  avail all the offers .<br><br>HURRY UP!...
				</h6>";
			}
			?>
				
				
			</div>
		</div>

		<div class="home-img">
			<img src="img/home.png">
		</div>
	</section>
	<!-- //popup model -->
	<section>
		<div class="bg-model">
			<div class="model-content">
			<div class="center">
      
			
	  <h1>Login</h1>
<form method="post" action="login_signup.php">
  <div class="txt_field">
	<input type="text" name="email" required>
	<span></span>
	<label>E-mail</label>
  </div>
  <div class="txt_field">
	<input type="password"  name="password" required>
	<span></span>
	<label>Password</label>
  </div>
  <div class="pass">Forgot Password?</div>
  <P>Don't have an account?<a href="#signup">signup</a></P>
  <br>
  <input type="submit" value="Login" name="login">
  <div class="signup_link">
	Welcome Back </a>
  </div>
</form>
</div>
				<div class="close">+</div>
			</div>
		</div>
		</section>
	<!---start container section---->
	<section class="container">
		<div class="container-box">
			<div class="container-img">
				<img src="img/con1.svg">
			</div>
			<div class="container-text">
				<h4>5K</h4>
				<p>Online Courses</p>
			</div>
		</div>

		<div class="container-box">
			<div class="container-img">
				<img src="img/con2.svg">
			</div>
			<div class="container-text">
				<h4>5K</h4>
				<p>Online Courses</p>
			</div>
		</div>

		<div class="container-box">
			<div class="container-img">
				<img src="img/con3.svg">
			</div>
			<div class="container-text">
				<h4>5K</h4>
				<p>Online Courses</p>
			</div>
		</div>

		<div class="container-box">
			<div class="container-img">
				<img src="img/con4.svg">
			</div>
			<div class="container-text">
				<h4>5K</h4>
				<p>Online Courses</p>
			</div>
		</div>

	</section>
	
		<!-- signup -->
	<section>
		<div class="bg-model2">
			<div class="model-content2">
			<div class="center2">
      
			
	  <h1>Sign Up</h1>
<form method="post" action="login_signup.php">
  <div class="txt_field">
	<input type="text" name="name" required>
	<span></span>
	<label>Name</label>
  </div>
  <div class="txt_field">
	<input type="text" name="email" required>
	<span></span>
	<label>E-mail</label>
  </div>
  <div class="txt_field">
	<input type="password"  name="password" required>
	<span></span>
	<label>Password</label>
  </div>
  <div class="pass">Already have an accout? <a href="">Login</a></div>
  <input type="submit" value="signup" name="signup">
  <div class="signup_link">Welcome </a>
  </div>
</form>
</div>
				<div class="close2">+</div>
			</div>
		</div>
		</section>
	<!---start categories section---->
	<section class="categories" id="categories">
		<div class="center-text">
			<h5>CATEGORIES</h5>
			<h2>Popular Categories</h2>
		</div>

		<div class="categories-content">
			<div class="box">
				<img src="img/app.png">
				<h3>App Development</h3>
				<p>5 Courses</p>
			</div>

			<div class="box">
				<img src="img/cate2.png">
				<h3>Angular Development</h3>
				<p>5 Courses</p>
			</div>

			<div class="box">
				<img src="img/web.png">
				<h3>Web Development</h3>
				<p>5 Courses</p>
			</div>

			<div class="box">
				<img src="img/datascience.png">
				<h3>Data Science</h3>
				<p>5 Courses</p>
			</div>

		</div>

		<div class="main-btn">
			<a href="#" class="btn">All Categories</a>
		</div>
	</section>

	<!---start course section---->
	<?php
        $sql ="SELECT * FROM course";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
			?>
	<section class="courses" id="courses">
		<div class="center-text">
			<h5>COURSES</h5>
			<h2>Explore Popular Courses</h2>
		</div>
        
		<div class="courses-content">
		<?php while($row = $result->fetch_assoc()){ ?>
			<div class="row">
				<img src=".<?php  echo $row['course_img']; ?>">
				<div class="courses-text">
					<h5>&#8377;<?php echo $row['course_price']; ?></h5>
					<h3><?php echo $row['course_name']; ?></h3>
					<h6><?php echo $row['course_duration']; ?></h6>
					<div class="rating">
					<div class="main-btn_2">
			<a href="watchcourse.php?course_id=<?php echo $row['course_id'] ;?>" class="btn">Start course</a>
		</div>
						<div class="review">
						
							<p>{5 Reviews}</p>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>

			

		</div>
		<?php   } ?>

		<div class="main-btn">
			<a href="#" class="btn">All Courses</a>
		</div>
	</section>

	<!---start cta section---->
	<section class="cta">
		<div class="center-text">
			<h5>Trusted By</h5>
			<h2>500+ Leading Universities And Companies</h2>
		</div>

		<div class="cta-content">
			<div class="cta-img">
				<img src="img/cta1.png">
			</div>

			<div class="cta-img">
				<img src="img/cta2.png">
			</div>

			<div class="cta-img">
				<img src="img/cta3.png">
			</div>

			<div class="cta-img">
				<img src="img/cta4.png">
			</div>

			<div class="cta-img">
				<img src="img/cta5.png">
			</div>

			<div class="cta-img">
				<img src="img/cta6.png">
			</div>

		</div>
	</section>

	<!---start about section---->
	<section class="about" id="about">
		<div class="about-img">
			<img src="img/about.png">
		</div>

		<div class="about-text">
			<h2>Want to share your knowledge? Join us a Mentor</h2>
			<p>High-definition video is video of higher resolution and quality than standard-definition. While there is no standardized meaning for high-definition, generally any video.</p>
			<h4>Best Courses</h4>
			<h5>Top rated Instructors</h5>
			<a href="#" class="btn">Read More</a>
		</div>
	</section>
<!-- //popup model -->
<section>
	<div class="abg-model">
		<div class="amodel-content">
			<div class="center">
      
			
			<h1>Login</h1>
      <form method="post" action="../adminlogin.php">
        <div class="txt_field">
          <input type="text" name="admin_email" required>
          <span></span>
          <label>Admin E-mail</label>
        </div>
        <div class="txt_field">
          <input type="password"  name="admin_pass" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <input type="submit" value="Login" name="signin">
        <div class="signup_link">
          Welcome Back </a>
        </div>
      </form>
	</div>
			<div class="aclose">+</div>
		</div>
	</div>
	<!---start contact section---->
	<section class="contact" id="contact">
		
	</section>
		<div class="main-contact">
			<div class="contact-content">
				<img src="img/edutech_logo.png">
				<li><a href="#">Facebook</a></li>
				<li><a href="#">Instagram</a></li>
				<li><a href="#">Twitter</a></li>
			</div>

			<div class="contact-content">
				<li><a href="#home">Home</a></li>
			  <li><a href="#categories">Categories</a></li>
			  <li><a href="#courses">Courses</a></li>
			  <li><a href="#about">About Us</a></li>
			  <li><a href="#contact">Contact</a></li>
			</div>

			<div class="contact-content">
				<li><a href="#">Profile</a></li>
				<li><a href="#">Login</a></li>
				<li><a href="#">Register</a></li>
				<li><a href="#">Instructor</a></li>
				<li><a href="#">Dashboard</a></li>
			</div>

			<div class="contact-content">
				<li><a href="#">Edu-tech,<br> 0000000, 000000</a></li>
				<li><a href="#">edutech@gmail.com</a></li>
				<li><a href="#">8888888888</a></li>
				<li style="cursor:pointer;"><a  id="adminlogin" class="adminlogin" >Admin Login</a></li>
			</div>

		</div>
	</section>
	


	<div class="last-text">
		<p>© 2023 . All rights reserved.</p>
	</div>

	<!-- -custom js link--
	<script type="text/javascript" src="js/script.js"></script>

</body>
</html> -->

	<script src="js.js"></script>
</body>
</html>