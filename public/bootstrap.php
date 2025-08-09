<?php
// ... existing code ...
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}
?>
<script>const CURRENT_USER = <?= isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 'null' ?>;</script>