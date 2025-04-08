<?php require_once(__DIR__ . '/config.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contacto</title>
  <script src="https://kit.fontawesome.com/b408879b64.js" crossorigin="anonymous"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      position: relative;
      background: url('<?= BASE_URL ?>/multimedia/contac_1.jpg') no-repeat center center/cover;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(2, 50%);
      padding: 20px;
      gap: 10px;
      width: 1000px;
      background: #006400;
      border-radius: 10px;
      box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.3);
    }

    .box-info {
      color: #fff;
      display: flex;
      flex-direction: column;
      gap: 50px;
    }

    .box-info h1 {
      text-align: left;
      letter-spacing: 5px;
    }

    .data p {
      font-size: 1rem;
    }

    .data p i {
      color: #008000;
      margin-right: 10px;
      font-size: 25px;
    }

    .links {
      display: flex;
      gap: 15px;
    }

    .links a {
      text-decoration: none;
      width: 40px;
      height: 40px;
      background: #008000;
      text-align: center;
      transition: .1s;
      border-radius: 6px;
    }

    .links a i {
      color: #fff;
      line-height: 40px;
      font-size: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
      text-align: center;
      gap: 15px;
    }

    .input-box input,
    .input-box textarea {
      width: 100%;
      padding: 10px;
      background: #fff;
      border: 3px solid transparent;
      color: #000;
      outline: none;
      transition: .3s;
    }

    .input-box input:focus,
    .input-box textarea:focus {
      border-bottom: 3px solid #008000;
      animation: shake .2s;
    }

    form button {
      width: 100%;
      padding: 10px;
      background: #008000;
      color: #fff;
      border: none;
      cursor: pointer;
      font-size: 1rem;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
      20%, 40%, 60%, 80% { transform: translateX(10px); }
    }

    @media screen and (max-width: 600px) {
      .container {
        width: 95%;
        display: flex;
        flex-direction: column;
        gap: 20px;
      }
    }

    .whatsapp-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 50px;
      height: 50px;
      z-index: 1000;
    }

    .whatsapp-button img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
      transition: transform 0.2s ease-in-out;
    }

    .whatsapp-button img:hover {
      transform: scale(1.1);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="box-info">
      <h1>CONTÁCTATE CON NOSOTROS</h1>
      <div class="data">
        <p><i class="fa-solid fa-phone"></i> +57 302 5123507 </p><br>
        <p><i class="fa-solid fa-envelope"></i> fontalvocoronadom9@gmail.com</p><br>
        <p><i class="fa-solid fa-location-dot"></i> Manzana 12 Casa 12 Villa Jaidith </p>
      </div>
      <div class="links">
        <a href="https://www.facebook.com/manuelfabianfontalvocoronado/"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/manuelfabianfontalvocoronado/"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.youtube.com/@manuelfabianfontalvocorona8019/community"><i class="fa-brands fa-youtube"></i></a>
        <a href="https://www.linkedin.com/in/manuel-fabian-fontalvo-coronado-614129310/"><i class="fa-brands fa-linkedin"></i></a>
      </div>
    </div>

    <form action="https://formsubmit.co/manuelfabianf@gmail.com" method="POST">
      <input type="hidden" name="_captcha" value="false">
      <input type="hidden" name="_next" value="<?= BASE_URL ?>/gracias.php">
      <div class="input-box">
        <input type="text" name="name" placeholder="Nombre y apellido" required>
      </div>
      <div class="input-box">
        <input type="email" name="email" required placeholder="Correo electrónico">
      </div>
      <div class="input-box">
        <input type="text" name="subject" placeholder="Asunto">
      </div>
      <div class="input-box">
        <textarea name="message" placeholder="Escribe tu mensaje..." required></textarea>
      </div>
      <button type="submit">Enviar mensaje</button>
    </form>
  </div>

  <div class="whatsapp-button">
    <a aria-label="Chat on WhatsApp" href="https://wa.me/+573025123507" target="_blank">
      <img alt="Chat on WhatsApp" src="<?= BASE_URL ?>/multimedia/WhatsAppButtonGreenLarge.png">
    </a>
  </div>
</body>
</html>
