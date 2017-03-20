<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="auth_tokens",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="auth_tokens_value_unique", columns={"value"})}
 * )
 */
class AuthToken
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
    protected $value;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User")
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
     * [getCreatedAt description]
     * @return [type] [description]
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * [setCreatedAt description]
     * @param DateTime $createdAt [description]
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
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
}
