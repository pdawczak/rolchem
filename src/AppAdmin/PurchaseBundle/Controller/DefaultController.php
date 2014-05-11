<?php

namespace AppAdmin\PurchaseBundle\Controller;

use App\OrderBundle\Entity\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/orders")
 *
 * Class DefaultController
 * @package AppAdmin\PurchaseBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_order_index")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'purchases' => $this->getRepository()->findBy(array(), array('createdAt' => 'ASC'))
        );
    }

    /**
     * @Route("/{purchaseId}/show", name="admin_order_show")
     * @ParamConverter("purchase", class="AppOrderBundle:Purchase", options={"id" = "purchaseId"})
     * @Template()
     */
    public function showAction(Purchase $purchase)
    {
        return array(
            'purchase' => $purchase,
            'items'    => $purchase->getPurchaseItems(),
        );
    }

    /**
     * @Route("/{purchaseId}/finish", name="admin_order_finish")
     * @ParamConverter("purchase", class="AppOrderBundle:Purchase", options={"id" = "purchaseId"})
     */
    public function finishAction(Request $request, Purchase $purchase)
    {
        $purchase->setFinished(true);

        $this->getDoctrine()->getManager()->persist($purchase);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->add('success', 'Zamówienie zostało zonaczone jako wykonane.');
        return $this->redirect($request->headers->get('referer'));
    }

    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppOrderBundle:Purchase');
    }
}
