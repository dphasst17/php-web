
<?php 
    include 'model/contact.php'; 
    $css = file_get_contents('view/content/contact/contact.css');
    echo "<style>" . $css . "</style>";
    
?>
    

    <div class="contact">
       <div class="contactContainer">
            <div class="content">
                <div class="contactTitle">
                    <p>CONTACT US</p>
                </div>
                <div class="contactForm">
                    <form method="post" action="model/contact.php">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required><br><br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" cols="30" required></textarea><br><br>
                        <input type="submit" value="Submit">
                    </form>
                    
                </div>
            </div>
       </div>
    </div>

    