
# Basic HTTP Authentication

This is a simple function that provides Basic HTTP Authentication.

Please note that basic HTTP authentication is **not secure**. It transmits usernames and
passwords in plain text across the wire (it is *probably* secure over HTTPS, but I am not a
security expert).

It is also generally considered a poor user experience.

So, that being said, if you still want to use basic HTTP authentication, then...

### Let's get started

Include this project using composer:

```bash
$ composer require saffyre/basic-http-authentication
```

You may need to use `php composer.phar` instead of `composer`, depending on your setup.
You can also manually add `"saffyre/basic-http-authentication": "^1.0"` to your composer.json file.
This is not a composer tutorial, so go look that up.

Here's how you use it:

```php
<?php


$success = \Saffyre\basicHttpAuth("Please log in.", function($username, $password) {
    // Validate the username and password.
    // You might connect to a database or read a file on your server, etc.
    // Return 'true' if the user authenticates successfully.
    return $username == 'admin' && $password == 'pass123';
});

if ($success)
{
    // The user is logged in, do your thing.
    echo "Welcome.";
}
else
{
    // The user clicked "Cancel" in the login box or is otherwise not logged in.
    // Show some kind of error message.
    echo "Please log in to continue.";
}
```

That's all. Happy authenticating!
