<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/DBconection.php';
$conn = DBconection::connectDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./videocalls.css">
  <title>Video Call App</title>
</head>

<body>

  <div id="streams-containers">
    <div class="video-placeholder">
      <video id="user-1" autoplay muted playsinline></video>
    </div>
  </div>

  <div class="buttons">
    <div class="call-btn" id="toggle-cam"><img src="../assets/icons/camera-on.png" alt="camera info"></div>
    <div class="call-btn" id="toggle-mic"><img src="../assets/icons/mic-on.png" alt="mic info"></div>
    <div class="call-btn" id="share-screen"><img src="../assets/icons/screen-share.png" alt="mic info"></div>
  </div>

</body>

<script>
  var chanelId = '<?php echo $_GET['chanelId'] ?>';
</script>
<script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script src="videocalls.js"></script>

</html>