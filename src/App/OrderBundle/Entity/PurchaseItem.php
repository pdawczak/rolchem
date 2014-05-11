<?php

namespace App\OrderBundle\Entity;

use App\ProductBundle\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 * PurchaseItem
 *
 * @ORM\Table(name="purchase_items")
 * @ORM\Entity
 */
class PurchaseItem
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
     * @ORM\ManyToOne(targetEntity="Purchase", inversedBy="purchaseItems")
     * @ORM\JoinColumn(name="purchase_id", referencedColumnName="id")
     */
    protected $purchase;

    /**
     * @var \App\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="App\ProductBundle\Entity\Product")
     */
    protected $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;

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
     * Set purchases
     *
     * @param \App\OrderBundle\Entity\Purchase $purchases
     * @return PurchaseItem
     */
    public function setPurchases(Purchase $purchases = null)
    {
        $this->purchases = $purchases;

        return $this;
    }

    /**
     * Get purchases
     *
     * @return \App\OrderBundle\Entity\Purchase 
     */
    public function getPurchases()
    {
        return $this->purchases;
    }

    /**
     * Set product
     *
     * @param \App\ProductBundle\Entity\Product $product
     * @return PurchaseItem
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \App\ProductBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return PurchaseItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
