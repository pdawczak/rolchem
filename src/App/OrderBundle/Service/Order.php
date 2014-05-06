<?php

namespace App\OrderBundle\Service;


use App\ProductBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Order
{
    /**
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function addProduct(Product $product)
    {
        return $this->add($product->getId());
    }

    /**
     * @param $id
     * @return bool
     */
    public function add($id)
    {
        if ($this->contains($id)) {
            return false;
        }

        $items = $this->getItems();
        $items[$id] = 0;
        $this->setItems($items);
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function contains($id)
    {
        foreach ($this->getItems() as $_id => $quantity) {
            if ($_id == $id) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getItems());
    }

    /**
     * @param array $items
     */
    protected function setItems(array $items)
    {
        $this->session->set('order_items', $items);
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->session->get('order_items', array());
    }
} 
