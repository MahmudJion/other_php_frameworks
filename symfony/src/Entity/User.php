<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    // ...

    public function getRoles()
    {
        // Return an array of roles for the user, e.g. ['ROLE_USER']
    }

    public function getPassword()
    {
        // Return the user's password
    }

    public function getSalt()
    {
        // Return a salt to use with the user's password
    }

    public function getUsername()
    {
        // Return the user's username
    }

    public function eraseCredentials()
    {
        // Remove sensitive data from the user entity
    }
}
