<?php $page_selected = 'chat'; 
session_start();
?>
<html>
<body>

<?php
    include("includes/header.php");
   ?>


<main>

<div class="container">

<textarea name="" id="mytext"></textarea>


</div>

</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
<script>

$("#mytext").emojioneArea({

    pickerPosition:"right"

});

</script>
<?php include('includes/footer.php') ?>
