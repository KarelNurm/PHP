<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Muutujate määramine ja puhastamine
    $name=strip_tags(trim($_POST["name"]));
    $email=filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message=strip_tags(trim($_POST["message"]));

    // Kontrollige, kas vormi andmed on olemas
    if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Määrake $error_message muutuja ja kavatsege seda kasutaja jaoks kuvada
        $error_message = "Oops! Midagi läks valesti. Palun täitke vorm uuesti.";
    }

    // Määrake e-posti aadress, kuhu soovite vormi andmeid saada
    $recipient = "kakumaku10@yahoo.com";

    // E-posti sisu
    $email_content="Nimi: $name\n";
    $email_content.="E-post: $email\n\n";
    $email_content.="Sõnum:\n$message\n";

    // E-posti pealkiri
    $email_subject="Uus sõnum kontaktivormist: $name";

    // E-posti päise määramine
    $email_headers="From: $name <$email>";

    // Saada e-post
    if(mail($recipient, $email_subject, $email_content, $email_headers)){
        // Kui e-post on saadetud, suunake kasutaja tagasi kontaktivormi lehele
        header("Location: kontakt.php");
    } else {
        // Kui e-posti saatmine ebaõnnestus, kuvage viga
        echo "Oops! Midagi läks valesti ja me ei saanud teie sõnumit saata.";
    }
} else {
    // Kui ei ole POST päring, suunake kasutaja tagasi kontaktivormi lehele
    header("Location: kontakt.php");
}
?>