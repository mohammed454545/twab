
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Messages
    |--------------------------------------------------------------------------
    */

    'success' => [
        'registered' => 'Account created successfully.',
        'logged_in' => 'Logged in successfully.',
        'logged_out' => 'Logged out successfully.',
        'refreshed' => 'Token refreshed successfully.',
        'user_retrieved' => 'Current user retrieved successfully.',
    ],

    'errors' => [
        'invalid_credentials' => 'The email or password is incorrect.',
        'unauthenticated' => 'You must log in to access this resource.',
        'unauthorized' => 'You do not have permission to perform this action.',
        'token_expired' => 'The token has expired. Please refresh it.',
        'token_invalid' => 'The token is invalid.',
        'token_blacklisted' => 'The token has been revoked. Please log in again.',
        'token_missing' => 'Authentication token was not provided.',
        'authentication_failed' => 'Authentication failed.',
        'registration_failed' => 'Unable to create the account.',
        'login_failed' => 'Unable to log in.',
        'logout_failed' => 'Unable to log out.',
        'refresh_failed' => 'Unable to refresh the token.',
        'user_not_found' => 'Unable to find the current user.',
        'email_not_found' => 'This email address is not registered.',
        'incorrect_password' => 'The password is incorrect.',
    ],

];
