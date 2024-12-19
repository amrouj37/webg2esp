function validateAndSend() {
    console.log("Validation triggered");

    // Collect field values
    var deliveryAddress = document.getElementById("adresse_livraison").value.trim();
    var billingAddress = document.getElementById("adresse_facturation").value.trim();
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();

    // Validate each field
    if (deliveryAddress === "") {
        alert("Please enter a delivery address.");
        document.getElementById("adresse_livraison").focus();
        return false; // Prevent form submission
    }

    if (billingAddress === "") {
        alert("Please enter a billing address.");
        document.getElementById("adresse_facturation").focus();
        return false; // Prevent form submission
    }

    if (deliveryAddress === billingAddress) {
        if (!confirm("Your delivery and billing addresses are the same. Do you want to proceed?")) {
            return false; // Prevent form submission
        }
    }

    if (name === "") {
        alert("Please enter your name.");
        document.getElementById("name").focus();
        return false; // Prevent form submission
    }

    if (email === "") {
        alert("Please enter your email address.");
        document.getElementById("email").focus();
        return false; // Prevent form submission
    }

    if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        document.getElementById("email").focus();
        return false; // Prevent form submission
    }

    console.log("Validation passed");

    // Send email only after validation
    sendMail();
    return false; // Prevent default form submission to process checkout
}

function validateEmail(email) {
    // Basic email validation regex
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function sendMail() {
    let params = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        subject: "Order Confirmation",
        message: "Your order has been successfully confirmed!",
    };

    emailjs.send("service_40nyc1s", "template_6ljgrxh", params)
        .then(function(response) {
            console.log("Email sent successfully:", response);
            alert("Email sent successfully!");

            // Redirect to checkoutpage.php after the email is sent successfully
            window.location.href = "checkoutpage.php"; // Change this path as per your directory structure
        })
        .catch(function(error) {
            console.log("Error sending email:", error);
            alert("Error: " + error.text);
        });
}
