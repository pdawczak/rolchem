<?php

namespace App\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Purchase
 *
 * @ORM\Table(name="purchases")
 * @ORM\Entity(repositoryClass="App\OrderBundle\Repository\PurchaseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Purchase
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
     * @var PurchaseDetails
     *
     * @ORM\OneToOne(targetEntity="PurchaseDetails", mappedBy="purchase", cascade={"persist", "remove"})
     */
    protected $purchaseDetails;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="PurchaseItem", mappedBy="purchase", cascade={"persist", "remove"})
     */
    protected $purchaseItems;

    /**
     * @var boolean
     *
     * @ORM\Column(name="finished", type="boolean")
     */
    protected $finished = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->purchaseItems = new ArrayCollection();
    }

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
     * Set purchaseDetails
     *
     * @param \App\OrderBundle\Entity\PurchaseDetails $purchaseDetails
     * @return Purchase
     */
    public function setPurchaseDetails(PurchaseDetails $purchaseDetails = null)
    {
        $this->purchaseDetails = $purchaseDetails;

        if (! empty ($purchaseDetails)) {
            $purchaseDetails->setPurchase($this);
        }

        return $this;
    }

    /**
     * Get purchaseDetails
     *
     * @return \App\OrderBundle\Entity\PurchaseDetails 
     */
    public function getPurchaseDetails()
    {
        return $this->purchaseDetails;
    }

    /**
     * Add purchaseItems
     *
     * @param \App\OrderBundle\Entity\PurchaseItem $purchaseItems
     * @return Purchase
     */
    public function addPurchaseItem(PurchaseItem $purchaseItems)
    {
        $this->purchaseItems[] = $purchaseItems;
        $purchaseItems->setPurchases($this);

        return $this;
    }

    /**
     * Remove purchaseItem
     *
     * @param \App\OrderBundle\Entity\PurchaseItem $purchaseItem
     */
    public function removePurchaseItem(PurchaseItem $purchaseItem)
    {
        $this->purchaseItems->removeElement($purchaseItem);
    }

    /**
     * Get purchaseItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPurchaseItems()
    {
        return $this->purchaseItems;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Purchase
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set finished
     *
     * @param boolean $finished
     * @return Purchase
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return boolean 
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @return string
     */
    public function getOrderer()
    {
        return $this->getPurchaseDetails()->getFullName();
    }
}
