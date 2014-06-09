<?php

namespace App\OrderBundle\Controller;

use App\OrderBundle\Entity\Purchase;
use App\OrderBundle\Entity\PurchaseDetails;
use App\OrderBundle\Entity\PurchaseItem;
use App\OrderBundle\Service\Order;
use App\ProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package App\OrderBundle\Controller
 *
 * @Route("/zamowienie")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_order_new")
     * @Template()
     */
    public function newAction()
    {
        return array();
    }

    /**
     * @Route("/add/{productId}", name="app_order_addItem")
     * @ParamConverter("product", class="AppProductBundle:Product", options={"id" = "productId"})
     * Method("POST")
     * @Template()
     */
    public function addItemAction(Product $product)
    {
        $success = $this->getOrderService()->addProduct($product);

        $data = array(
            'name'    => $product->getName(),
            'image'   => $this->generateThumbnailPath($product),
            'success' => $success,
            'message' => $success ? 'Produkt został dodany do zamówienia.' : 'Produkt już znajduje się w zamówieniu.',
        );

        return new JsonResponse($data);
    }

    /**
     * @Route("/items", name="app_oder_items")
     */
    public function getItemsAction()
    {
        $items = $this->getOrderService()->getItems();
        $data  = array();

        foreach ($items as $id => $quantity) {
            /** @var \App\ProductBundle\Entity\Product $product */
            $product = $this->getProductRepository()->find($id);

            $data[] = array(
                'id'        => $id,
                'name'      => $product->getName(),
                'image'     => $this->generateThumbnailPath($product),
                'quantity'  => $quantity,
            );
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/remove", name="app_order_removeItem")
     * @Method("POST")
     */
    public function removeItemAction(Request $request)
    {
        $id = $request->request->get('productId');

        $this->getOrderService()->remove($id);

        return new JsonResponse(array('success' => true));
    }

    /**
     * @Route("/place", name="app_order_place")
     */
    public function placeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $data = $request->request->all();

        // Reference only
//        $data = array(
//            'orderDetails' => array(
//                'first_name' => 'qweqwe',
//                'last_name' => 'qweqweqwe',
//                'phone' => 'qweqwe',
//                'email' => 'qweqwe@asdasd.pl',
//                'company_name' => 'qweqweqwe',
//                'city' => 'qweqwe',
//                'address' => 'qweqwe',
//                'post_code' => 'qweqwe'
//            ),
//            'orderItems' => array(
//                array(
//                    'id' => 1,
//                    'name' => 'Testowy Znicz',
//                    'quantity' => 1,
//                    '$$hashKey' => '00A'
//                )
//            ),
//        );

        $orderDetails = $data['orderDetails'];

        $purchase = new Purchase();

        $purchaseDetails = new PurchaseDetails();
        $purchaseDetails->setFullName(sprintf('%s %s', $orderDetails['first_name'], $orderDetails['last_name']))
            ->setEmail($orderDetails['email'])
            ->setPhoneNumber($orderDetails['phone'])
            ->setPostalCode($orderDetails['post_code'])
            ->setCity($orderDetails['city'])
            ->setAddress($orderDetails['address']);

        if (isset ($orderDetails['company_name'])) {
            $purchaseDetails->setCompanyName($orderDetails['company_name']);
        }

//        $em->persist($purchaseDetails);

        $purchase->setPurchaseDetails($purchaseDetails);

        foreach ($data['orderItems'] as $orderItem) {
            $purchaseItem = new PurchaseItem();
            $purchaseItem->setProduct($this->getProductRepository()->find($orderItem['id']))
                ->setQuantity($orderItem['quantity']);

            $purchase->addPurchaseItem($purchaseItem);

//            $em->persist($purchaseItem);
        }

        $em->persist($purchase);
        $em->flush();

        $this->getOrderService()->clear();

        return new JsonResponse(array('success' => true));
    }

    /**
     * @return Order
     */
    protected function getOrderService()
    {
        return $this->get('order_service');
    }

    /**
     * @param Product $product
     * @return string
     */
    protected function generateThumbnailPath(Product $product)
    {
        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
        $path = $helper->asset($product, 'image');
        return $this->get('liip_imagine.cache.manager')->getBrowserPath($path, 'product_cart');
    }

    /**
     * @return \App\ProductBundle\Repository\ProductRepository
     */
    protected function getProductRepository()
    {
        return $this->getDoctrine()->getRepository('AppProductBundle:Product');
    }
}
