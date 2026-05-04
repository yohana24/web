<?php
include 'auth_check.php';
include 'lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo t('contact_title') ?? 'Contact Us'; ?></title>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&family=Mynerve&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ===== CSS كما هو بدون أي تعديل ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Tilt Warp', cursive;
}

html, body {
    height: 100%;
    overflow: hidden;
    background: #111;
    color: #fff;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

form {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(10px);
    padding: 40px;
    border-radius: 15px;
    width: 600px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    box-shadow: 0 0 50px rgba(0,0,0,0.5);
    animation: float 4s ease-in-out infinite;
}

form:hover {
    animation-play-state: paused;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-12px); }
    100% { transform: translateY(0px); }
}

form h1 {
    font-size: 3em;
    text-align: center;
}

form h2, form h4 {
    text-align: center;
    font-weight: 400;
}

input[type="text"], input[type="email"], textarea {
    background: none;
    border: none;
    border-bottom: 2px solid #fff;
    color: #fff;
    font-size: 16px;
    padding: 10px;
    outline: none;
}

.name-group {
    display: flex;
    gap: 10px;
}

textarea {
    min-height: 100px;
    resize: none;
}

#button {
    width: 120px;
    padding: 10px;
    margin: 0 auto;
    border: none;
    border-radius: 5px;
    background: #fff;
    color: #333;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

#button:hover {
    opacity: 0.7;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 10px;
}

.social-icons svg{
    width: 30px;
    height: 30px;
    cursor: pointer;
    transition: 0.3s;
}

.social-icons svg:hover {
    transform: scale(1.1);
}

.btn {
    width: 150px;
    padding: 10px;
    margin: 20px auto 0 auto;
    border: none;
    border-radius: 5px;
    background: #fff;
    color: #333;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: 0.3s;
}

.btn:hover {
    opacity: 0.7;
}

@media(max-width: 650px){
    form {
        width: 90%;
        padding: 20px;
    }
    .name-group {
        flex-direction: column;
    }
}
</style>
</head>
<body>

<div class="container">
    <form id="contactForm">

        <h1><?php echo t('contact_title') ?? 'Contact Us'; ?></h1>

        <div class="name-group">
            <input type="text" id="firstName" name="firstName"
                placeholder="<?php echo t('first_name') ?? 'First Name'; ?>" required>

            <input type="text" id="lastName" name="lastName"
                placeholder="<?php echo t('last_name') ?? 'Last Name'; ?>" required>
        </div>

        <input type="email" id="email" name="email"
            placeholder="<?php echo t('email') ?? 'Email'; ?>" required>

        <h4><?php echo t('message_here') ?? 'Type Your Message Here:'; ?></h4>

        <textarea name="message"
            placeholder="<?php echo t('message_placeholder') ?? 'Your message...'; ?>"
            required></textarea>

        <input type="submit" value="<?php echo t('send') ?? 'Send'; ?>" id="button">

        <h2><?php echo t('follow_us') ?? 'Follow Us'; ?></h2>

        <div class="social-icons">
            <!-- نفس SVG بدون تغيير -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="rgb(255,255,255)" d="M240 363.3L240 576L356 576L356 363.3L442.5 363.3L460.5 265.5L356 265.5L356 230.9C356 179.2 376.3 159.4 428.7 159.4C445 159.4 458.1 159.8 465.7 160.6L465.7 71.9C451.4 68 416.4 64 396.2 64C289.3 64 240 114.5 240 223.4L240 265.5L174 265.5L174 363.3L240 363.3z"/></svg>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="rgb(255,255,255)" d="M523.4 215.7C523.7 220.2 523.7 224.8 523.7 229.3C523.7 368 418.1 527.9 225.1 527.9C165.6 527.9 110.4 510.7 64 480.8C72.4 481.8 80.6 482.1 89.3 482.1C138.4 482.1 183.5 465.5 219.6 437.3C173.5 436.3 134.8 406.1 121.5 364.5C128 365.5 134.5 366.1 141.3 366.1C150.7 366.1 160.1 364.8 168.9 362.5C120.8 352.8 84.8 310.5 84.8 259.5L84.8 258.2C98.8 266 115 270.9 132.2 271.5C103.9 252.7 85.4 220.5 85.4 184.1C85.4 164.6 90.6 146.7 99.7 131.1C151.4 194.8 229 236.4 316.1 240.9C314.5 233.1 313.5 225 313.5 216.9C313.5 159.1 360.3 112 418.4 112C448.6 112 475.9 124.7 495.1 145.1C518.8 140.6 541.6 131.8 561.7 119.8C553.9 144.2 537.3 164.6 515.6 177.6C536.7 175.3 557.2 169.5 576 161.4C561.7 182.2 543.8 200.7 523.4 215.7z"/></svg>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path fill="rgb(255,255,255)" d="M320.3 205C256.8 204.8 205.2 256.2 205 319.7C204.8 383.2 256.2 434.8 319.7 435C383.2 435.2 434.8 383.8 435 320.3C435.2 256.8 383.8 205.2 320.3 205z"/></svg>
        </div>

        <a href="products.php" class="btn">
            <?php echo t('back_menu') ?? 'Back Menu'; ?>
        </a>

    </form>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e){
    e.preventDefault();

    fetch('contact_submit.php', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert("<?php echo t('sent_success') ?? 'Message sent successfully!'; ?>");
            this.reset();
        } else {
            alert("<?php echo t('sent_error') ?? 'Error sending message.'; ?>");
        }
    });
});
</script>

</body>
</html>