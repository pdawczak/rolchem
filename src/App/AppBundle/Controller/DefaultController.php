<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/kontakt", name="app_contact")
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }

    /**
     * @Template()
     */
    public function topNavAction(Request $request)
    {
        $active = 'about';

        if (strpos($request->getPathInfo(), '/oferta') !== false) {
            $active = 'offer';
        }

        if (strpos($request->getPathInfo(), '/zamowienie') !== false) {
            $active = 'order';
        }

        if (strpos($request->getPathInfo(), '/kontakt') !== false) {
            $active = 'contact';
        }

        return array(
            'active'          => $active,
            'orderItemsCount' => $this->get('order_service')->count(),
        );
    }
}
