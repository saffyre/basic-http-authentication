<?php

namespace Saffyre;

/**
 * Prompts the user for a username and password, and validates the credentials using the specified callback.
 * The callback receives the username and password as plain text strings and should return true or false indicating
 * whether the credentials were valid.
 *
 * The return value is true or false.
 * If the return value is true, the user has entered valid credentials and your script may continue.
 * If the return value is false, there were invalid or no credentials specified. You should stop execution and
 * output an error page.
 *
 * @param string $message The "realm" message to show to the user
 * @param callable $validate
 * @return bool
 */
function basicHttpAuth($message, callable $validate)
{
    $username = null;
    $password = null;

    if (isset($_SERVER['PHP_AUTH_USER']))
    {
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];
    }
    elseif (isset($_SERVER['HTTP_AUTHORIZATION']))
    {
        if (strpos(strtolower($_SERVER['HTTP_AUTHORIZATION']), 'basic') === 0)
            list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
    }

    if ($username) {
        return $validate($username, $password);
    } else {
        header("WWW-Authenticate: Basic realm=\"$message\"", true, 401);
        return false;
    }
}
