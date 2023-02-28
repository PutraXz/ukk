<?php
session_start();
session_destroy();
?>
<script>
    alert('anda berhasil logout !!');
    window.location.href="index.php";
</script>