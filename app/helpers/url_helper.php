<?php
// Redirect to specified page
function redirect($page) {
    header('location: ' . URLROOT . '/' . $page);
} 