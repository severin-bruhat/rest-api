<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity()
* @ORM\Table(name="users",
*      uniqueConstraints={@ORM\UniqueConstraint(name="users_email_unique",columns={"email"})}
* )
*/
class User
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
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="Preference", mappedBy="user")
     * @var Preference[]
     */
    protected $preferences;

    /**
     * used for suggestions
     */
    const MATCH_VALUE_THRESHOLD = 25;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->preferences = new ArrayCollection();
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
     * [setId description]
     * @param [type] $id [description]
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * [getFirstname description]
     * @return [type] [description]
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * [setFirstname description]
     * @param [type] $firstname [description]
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * [getLastname description]
     * @return [type] [description]
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * [setLastname description]
     * @param [type] $lastname [description]
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * [getEmail description]
     * @return [type] [description]
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * [setEmail description]
     * @param [type] $email [description]
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * [getPreferences description]
     * @return [type] [description]
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * [setPreferences description]
     * @param [type] $preferences [description]
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }

    /**
     * [preferencesMatch description]
     * @param  [type] $themes [description]
     * @return [type]         [description]
     */
    public function preferencesMatch($themes)
    {
        $matchValue = 0;
        foreach ($this->preferences as $preference) {
            foreach ($themes as $theme) {
                if ($preference->match($theme)) {
                    $matchValue += $preference->getValue() * $theme->getValue();
                }
            }
        }

        return $matchValue >= self::MATCH_VALUE_THRESHOLD;
    }
}
