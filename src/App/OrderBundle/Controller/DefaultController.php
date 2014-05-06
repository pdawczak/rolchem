<?php

namespace App\OrderBundle\Controller;

use App\OrderBundle\Service\Order;
use App\ProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DefaultController
 * @package App\OrderBundle\Controller
 *
 * @Route("/orders")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/add/{productId}", name="app_order_addItem")
     * @ParamConverter("product", class="AppProductBundle:Product", options={"id" = "productId"})
     * Method("POST")
     * @Template()
     */
    public function addItemAction(Product $product)
    {
        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
        $path = $helper->asset($product, 'image');
        $path = $this->get('liip_imagine.cache.manager')->getBrowserPath($path, 'product_cart');

        $success = $this->getOrderService()->addProduct($product);

        $data = array(
            'name'    => $product->getName(),
            'image'   => $path,
            'success' => $success,
            'message' => $success ? 'Produkt został dodany do zamówienia.' : 'Produkt już znajduje się w zamówieniu.',
        );

        return new JsonResponse($data);
    }

    /**
     * @return Order
     */
    protected function getOrderService()
    {
        return $this->get('order_service');
    }
}
