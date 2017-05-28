<?php


namespace UserStoryBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="UserStoryBundle\Entity\Person", mappedBy="user")
     */
    private $persons;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add person
     *
     * @param \UserStoryBundle\Entity\Person $person
     *
     * @return User
     */
    public function addPerson(\UserStoryBundle\Entity\Person $person)
    {
        $this->persons[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \UserStoryBundle\Entity\Person $person
     */
    public function removePerson(\UserStoryBundle\Entity\Person $person)
    {
        $this->persons->removeElement($person);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersons()
    {
        return $this->persons;
    }
}
