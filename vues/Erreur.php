<?php
$message = isset($data['message']) ? htmlspecialchars($data['message']) : "";
?>

<h1>Oups!</h1>
<p><?= $message ?></p>