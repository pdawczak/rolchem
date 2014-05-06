<?php

namespace App\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PurchaseDetails
 *
 * @ORM\Table(name="purchase_details")
 * @ORM\Entity
 */
class PurchaseDetails
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Purchase
     *
     * @ORM\OneToOne(targetEntity="Purchase", inversedBy="purchaseDetails")
     * @ORM\JoinColumn(name="purchase_id", referencedColumnName="id")
     */
    protected $purchase;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", nullable=true)
     */
    protected $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", nullable=true)
     */
    protected $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", nullable=true)
     */
    protected $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    protected $address;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set purchase
     *
     * @param \App\OrderBundle\Entity\Purchase $purchase
     * @return PurchaseDetails
     */
    public function setPurchase(Purchase $purchase = null)
    {
        $this->purchase = $purchase;

        return $this;
    }

    /**
     * Get purchase
     *
     * @return \App\OrderBundle\Entity\Purchase 
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return PurchaseDetails
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PurchaseDetails
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return PurchaseDetails
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return PurchaseDetails
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return PurchaseDetails
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return PurchaseDetails
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
     * Set address
     *
     * @param string $address
     * @return PurchaseDetails
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
}
