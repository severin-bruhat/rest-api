<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="places",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="places_name_unique",columns={"name"})}
 * )
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
     * @ORM\OneToMany(targetEntity="Price", mappedBy="place")
     * @var Price[]
     */
    protected $prices;

    /**
     * @ORM\OneToMany(targetEntity="Theme", mappedBy="place")
     * @var Theme[]
     */
    protected $themes;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->themes = new ArrayCollection();
    }

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

    /**
     * [setPrices description]
     * @param [type] $prices [description]
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    /**
     * [getPrices description]
     * @return [type] [description]
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * [getThemes description]
     * @return [type] [description]
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * [setThemes description]
     * @param [type] $themes [description]
     */
    public function setThemes($themes)
    {
        $this->themes = $themes;
    }
}
