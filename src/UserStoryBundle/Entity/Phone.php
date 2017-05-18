<?php

namespace UserStoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Phone
 *
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="UserStoryBundle\Repository\PhoneRepository")
 */
class Phone
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     * @Assert\Range(min="100000000", max="999999999",
     *      minMessage="Proszę podać poprawny numer telefonu",
     *      maxMessage="Proszę podać poprawny numer telefonu")
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10)
     * @Assert\Choice({"Służbowy","Prywatny"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="UserStoryBundle\Entity\User", inversedBy="phones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Phone
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \UserStoryBundle\Entity\User $user
     *
     * @return Phone
     */
    public function setUser(\UserStoryBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserStoryBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
