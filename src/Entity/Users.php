<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="document", type="string", length=20, nullable=true)
     */
    private $document;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=true)
     */
    private $password;



    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     *
     * @return  string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string|null  $username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of document
     *
     * @return  string|null
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set the value of document
     *
     * @param  string|null  $document
     *
     * @return  self
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of country
     *
     * @return  string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @param  string|null  $country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string|null  $password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
