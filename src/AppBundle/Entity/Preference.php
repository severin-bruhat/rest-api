<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="preferences",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="preferences_name_user_unique", columns={"name", "user_id"})}
 * )
 */
class Preference
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="preferences")
     * @var User
     */
    protected $user;

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
     * [getUser description]
     * @return [type] [description]
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * [setUser description]
     * @param User $user [description]
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * [Check if the theme name is the same as the user's preference
     * @param  Theme $theme [description]
     * @return [type]        [description]
     */
    public function match(Theme $theme)
    {
        return $this->name === $theme->getName();
    }
}
