<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="themes",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="themes_name_place_unique", columns={"name", "place_id"})}
 * )
 */
class Theme
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
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="themes")
     * @var Place
     */
    protected $place;

    /**
     * [getId description]
     * @return [type] [description]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * [setId description]
     * @param [type] $id [description]
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * [setName description]
     * @param [type] $name [description]
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * [getValue description]
     * @return [type] [description]
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * [setValue description]
     * @param [type] $value [description]
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * [getPlace description]
     * @return [type] [description]
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * [setPlace description]
     * @param Place $place [description]
     */
    public function setPlace(Place $place)
    {
        $this->place = $place;
    }
}
