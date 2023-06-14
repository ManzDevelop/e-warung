<?php
  require_once dirname(__FILE__) . "/../config.php";
  $_SESSION = array();
  session_destroy();
  $_SESSION = [];?>
      <script>
          window.location.replace("<?php echo BASE_URL; ?>");
      </script>
      <?php 
  exit;
?>