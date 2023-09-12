<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $mobileNo = $_POST["mobile_no"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zipCode = $_POST["zip_code"];
    
    $message = "Billing Address:\n";
    $message .= "First Name: $firstName\n";
    $message .= "Last Name: $lastName\n";
    $message .= "Email: $email\n";
    $message .= "Mobile No: $mobileNo\n";
    $message .= "Address Line 1: $address1\n";
    $message .= "Address Line 2: $address2\n";
    $message .= "Country: $country\n";
    $message .= "City: $city\n";
    $message .= "State: $state\n";
    $message .= "ZIP Code: $zipCode\n";
    
    // Set the recipient email address
    $to = "recipient@example.com"; // Replace with the recipient's email address
    
    // Set the email subject
    $subject = "New Order from $firstName $lastName";
    
    // Set additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        // Email sent successfully
        echo "Order placed successfully. You will receive an email confirmation shortly.";
    } else {
        // Email sending failed
        echo "Order placement failed. Please try again later.";
    }
} else {
    // Form was not submitted
    echo "Form submission error.";
}
?>
