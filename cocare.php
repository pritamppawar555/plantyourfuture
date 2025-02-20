<?php 
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "plant_your_future"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to insert data into the care table
    $stmt = $conn->prepare("INSERT INTO care (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
    $stmt->execute();

    // Check if data insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Message sent successfully!";
    } else {
        echo "Error: Message could not be sent.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="CodeHim">
      <title> Responsive Contact Us Page Example </title>
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/cocare.css">
  
  </head>
 
</script>
   <body>
      <header class="cd__intro">
        
         <center><h1>.....  Contact Us  .....  </h1></center>
        
         
      </header>
      <!--$%adsense%$-->
      <main class="cd__main">
       
         <section>
          <button class="btn1"onclick="handleButtonClick()">🔙Go back...</button>
          <script>
              function handleButtonClick() {
                  window.location.href='index.html'
              
              }
              
            </script>
    <div class="section-header">
      <div class="container">
        <h2>Contact Us</h2>
        <p>"Plant Your Future is your ultimate destination for all things green and growing. Our website offers a diverse range of premium plants, Plant Your Future provides expert advice, top-quality products, and a seamless shopping experience, empowering you to nurture your connection with nature and cultivate a brighter, greener future."
      </p>
      </div>
    </div>
    
    <div class="container">
      <div class="row">
        
        <div class="contact-info">
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-home"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Address</h4>
              <p>NH3 highway,Malegoan<br/> Nashik,Maharastra<br/>423208</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-phone"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Phone</h4>
              <p>957-9935-933</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-envelope"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Email</h4>
             <p>plantyourfuture@.com</p>
            </div>
          </div>
        </div>
        

        <div class="contact-form">
          <form method="post" id="contact-form">
            <h2>Send Message</h2>
            <div class="input-box">
              <input type="text" required="true" name="name">
              <span>Full Name</span>
            </div>
            
            <div class="input-box">
              <input type="email" required="true" name="email">
              <span>Email</span>
            </div>
            
            <div class="input-box">
              <textarea required="true" name="message"></textarea>
              <span>Type your Message...</span>
            </div>
            
            <div class="input-box">
              <input type="submit" value="Send" name="submit">
            </div>
          </form>
        </div> 
      </div>
    </div>
  </section>
         <!-- END EDMO HTML (Happy Coding!)-->
      </main>


<div id="footerContainer"></div>
      <script>
          load("footer.html", "footerContainer");
      </script>
      <style>
            #footerContainer{
                  align-items: end;
              }
      </style>
        
      <!-- Script JS -->
      <script src="./js/script.js"></script>
      <!--$%analytics%$-->
   </body>
</html>