<?php include('../includes/header.php') ?>
<head>
    <link rel="stylesheet" href="../css/style.css">
</head>
<html>
<head>
</head>
<body>

<button class="open-button" onclick="openChat()">Chat</button>

<div class="chat-popup" id="chatpopup">
  <form action="" class="form-container">
    <h1>Chat</h1>

    <label for="msg"><b>Message</b></label>

    <textarea name="" id="" cols="30" rows="10"></textarea>
    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeChat()">Close</button>
  </form>
</div>

<script>
function openChat() {
  document.getElementById("chatpopup").style.display = "block";
}

function closeChat() {
  document.getElementById("chatpopup").style.display = "none";
}
</script>

</body>
</html>