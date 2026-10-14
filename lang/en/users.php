
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Users Messages
    |--------------------------------------------------------------------------
    */

    'success' => [
        'created' => 'User created successfully.',
        'updated' => 'User updated successfully.',
        'deleted' => 'User deleted successfully.',
        'restored' => 'User restored successfully.',
        'retrieved' => 'User data retrieved successfully.',
        'listed' => 'Users list retrieved successfully.',
    ],

    'errors' => [
        'not_found' => 'The requested user was not found.',
        'create_failed' => 'Failed to create the user.',
        'update_failed' => 'Failed to update the user.',
        'delete_failed' => 'Failed to delete the user.',
        'restore_failed' => 'Failed to restore the user.',
        'unauthorized' => 'You must be logged in to access users.',
        'forbidden' => 'You do not have permission to perform this action on the user.',
    ],

    'messages' => [
        'empty' => 'No users available.',
        'confirm_delete' => 'Are you sure you want to delete this user?',
    ],

];
