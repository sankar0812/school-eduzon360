<!DOCTYPE html>
<html>
<head>
  <title> Mail</title>
  <script src=
    "https://smtpjs.com/v3/smtp.js">
  </script>

  <script type="text/javascript">
    function sendEmail() {
      Email.send({
        Host: "smtp.gmail.com",
        Username: "sender@email_address.com",
        Password: "Enter your password",
        To: 'balak1582@gmail.com',
        From: "sender@email_address.com",
        Subject: "Sending Email using javascript",
        Body: "Well that was easy!!",
      })
        .then(function (message) {
          alert("mail sent successfully")
        });
    }
  </script>
</head>

<body>
  <form method="post">
    <input type="button" value="Send Email"
        onclick="sendEmail()" />
  </form>
</body>
</html>
