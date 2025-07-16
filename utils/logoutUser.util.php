<?php
// utils/logoutUser.util.php

function logoutUser(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset();
    session_destroy();
}
