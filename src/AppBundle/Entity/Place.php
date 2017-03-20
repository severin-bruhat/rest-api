<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="places")
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $address;

    /**
     * [getId description]
     * @return [type] [description]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * [getName description]
     * @return [type] [description]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * [getAddress description]
     * @return [type] [description]
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * [setId description]
     * @param [type] $id [description]
     * @return Place
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * [setName description]
     * @param [type] $name [description]
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * [setAddress description]
     * @param [type] $address [description]
     * @return Place
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}
