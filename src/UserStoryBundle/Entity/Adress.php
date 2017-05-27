<?php

namespace UserStoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adress
 *
 * @ORM\Table(name="adress")
 * @ORM\Entity(repositoryClass="UserStoryBundle\Repository\AdressRepository")
 */
class Adress
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
     * @ORM\ManyToOne(targetEntity="UserStoryBundle\Entity\Person", inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=25, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=40, nullable=true)
     */
    private $street;

    /**
     * @var int
     *
     * @ORM\Column(name="houseNumber", type="integer", nullable=true)
     */
    private $houseNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="flatNumber", type="integer", nullable=true)
     */
    private $flatNumber;


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
     * Set city
     *
     * @param string $city
     *
     * @return Adress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Adress
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNumber
     *
     * @param integer $houseNumber
     *
     * @return Adress
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return int
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set flatNumber
     *
     * @param integer $flatNumber
     *
     * @return Adress
     */
    public function setFlatNumber($flatNumber)
    {
        $this->flatNumber = $flatNumber;

        return $this;
    }

    /**
     * Get flatNumber
     *
     * @return int
     */
    public function getFlatNumber()
    {
        return $this->flatNumber;
    }

    /**
     * Set person
     *
     * @param \UserStoryBundle\Entity\Person $person
     *
     * @return Adress
     */
    public function setPerson(\UserStoryBundle\Entity\Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \UserStoryBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
