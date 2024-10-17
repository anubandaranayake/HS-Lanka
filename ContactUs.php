<?php
    include_once("./index_Cus.php");
    require_once './Db/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="./css/home.Css">
    <link rel="stylesheet" href="./css/contact.Css">
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <br><br><br>
<div>
    <img src="./Images/logo/contact us.png" width ="1900px" height="340px">
</div>
<div>
<img src="./Images/logo/contact.jpg" width ="1900px" height="360px">
</div>
<br><br><br>
<div>
   <div class="para">
       <p>Our details are;</p>
   </div>
   <br><br>
   <div class ="para2">
    <p> Email :  hslanka7@gmail.com</p><br>
    <p>Tele_No : 0760 779 055   </p><br>
    <p> Address : 141/1/23,maliban street,colombo-11.</p>
   </div>
   <br><br>
   
   <br><br><br>
   <div class ="map">
    <img src="./Images/logo/map.png" width ="1900px" height="360px" >
   </div>
   <br><br>
   
   <br>
   <div class ="location">
    <p>Location map </p>
    <a href="https://www.google.com/maps/place/141+Maliban+Street,+Colombo+01100/@6.9356053,79.852881,17.75z/data=!4m5!3m4!1s0x3ae2591f4d0a82a7:0x924701465f9e5ec!8m2!3d6.9356692!4d79.8529294?entry=ttu&g_ep=EgoyMDI0MDkxOC4xIKXMDSoASAFQAw%3D%3D"> link </a>
   </div>
</div>

<?php
require_once './Db/connection.php';

// Initialize session

// Initialize variables
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = htmlspecialchars(trim($_POST["message"]));
    }

    // Check for errors before saving review
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        // Success message
        $success_message = "Review added successfully!";
    }
}
?>
<br><br><br><br><br>
<div class ="message">
    <p>Make sure to add a Review </p>
</div>
<section>
    <div class ="form-container">
        <form="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error"><?php echo $name_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $email_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
            <label>Your Message</label>
            <textarea name="message" rows="5"><?php echo $message; ?></textarea>
            <span class="error"><?php echo $message_err; ?></span>
        </div>
        <div class="addreview">
            <button type="submit" class="btn">Add Review</button>
        </div>

        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        </form=>
    </div>
</section>

<!-- Display the review on the same page -->
<?php if (!empty($name) && !empty($email) && !empty($message) && empty($name_err) && empty($email_err) && empty($message_err)): ?>
    <div class="reviews-display">
        <h3>Review by <?php echo $name; ?></h3>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Message:</strong> <?php echo $message; ?></p>
    </div>
<?php endif; ?>
<style>
        .form-container {
            background-color: #625D5D;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 15px;
            font-display: white;
        }
        .input-group label {
            display: block;
            margin-bottom: 10px;
        }
        .input-group input, .input-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #111010;
            border-radius: 5px;
            color: #111010;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .success {
            color: green;
            font-size: 1em;
        }
        .review-display {
            margin-left: 20px;
        }
        .addreview{
            margin-left: 754px;
            size-adjust: 2px;
            width: 7%;
            padding: 10px;
            background-color: #E9E8E7;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            
        }
        .para{
    font: 1em sans-serif;
    font-size: 28px;
    margin-left: 40%;

}

.para2{
    font: 1em sans-serif;
    font-size: 28px;
    margin-left: 40%;
}
.message{
    font: 2em sans-serif;
    margin-left: 40%;
    font-size: 28px;
}
.location{
    margin-left: 5%;
    font-size: 28px;
}
</style>







  <!-- Footer -->
  <div class="deliver_info">
        <div class="deliver_phone">
            <p class="deliver_phone_01">
                Contact Us
                <br><b>0760779055</b>
            </p>
        </div>
        <div class="deliver_img">
            <img class="deliver_img_01" src="./Images/stuff/deiliveryman.webp" alt="">
        </div>
        <div class="deliver_txt">
            <p class="deliver_txt_01">
                Your Order will be safe 
                <br>  Delivery to 
                <br>home step.
            </p>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-top">
            <div class="footer-logo">
                <img src="./Images/logo/logo.png" alt="Logo">
            </div>
            <div class="footer-paragraph">
                <p> HS Lanka Provides<br> varieties of<br> production which <br>you needed for your <br> day today life.</p>
            </div>
            
        </div>
        <div class="footer-middle">
            <ul>
                <p> Fast Direction </p>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Beautyproducts.php">Beauty Products</a></li>
                <li><a href="Electronics.php">Electronics</a></li>
                <li><a href="Homeandliving.php">Home and Living</a></li>
                <li><a href="WatchesandBags.php">Watches and Bags</a></li>
                <li><a href="AboutUs.php">About Us</a></li>
                <li><a href="ContactUs.php">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <div class="footer-contact">
                <pr>About Us:<br>141/1/23, Maliban Street,<br>Colombo - 11</pr><br><br><br>
                <p>Contact : 0764422488 <br>
                Hijas Mohommed</p>
            </div>
        </div>
        <div class="footer-icons">
            <p>follow us on</p>
                <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://whatsapp.com" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
    </footer>
    <footer>
        <p>&copy; 2024 HS Lanka</p>
    </footer>

    <!-- Link to JavaScript -->
    <script src="scripts.js"></script>
</body>