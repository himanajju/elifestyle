<?php

session_start();
session_destroy();
  die('
<script type="text/javascript">
  window.location.replace("/elifestyle/public/login");
</script>');


?>