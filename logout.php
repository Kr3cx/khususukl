<?php

session_start();

unset($_SESSION['username']);
unset($_SESSION['password']);

session_destroy();

echo "<script>
alert('Logout Successfully');
document.location = 'homepage.php';
</script>";

?>