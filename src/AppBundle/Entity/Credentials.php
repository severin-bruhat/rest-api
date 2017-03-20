<?php
namespace AppBundle\Entity;

/**
 * This class is used to transport the credential informations
 */
class Credentials
{
    protected $login;

    protected $password;

    /**
     * [getLogin description]
     * @return [type] [description]
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * [setLogin description]
     * @param [type] $login [description]
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * [getPassword description]
     * @return [type] [description]
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * [setPassword description]
     * @param [type] $password [description]
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
