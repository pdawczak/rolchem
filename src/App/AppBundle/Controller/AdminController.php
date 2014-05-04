<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
        return array();
    }

    /**
     * @param Request $request
     * @return array
     *
     * @Template()
     */
    public function mainMenuAction(Request $request)
    {
        $active = 'dashboard';

        if (strpos($request->getPathInfo(), '/admin/categories') !== false) {
            $active = 'categories';
        }

        if (strpos($request->getPathInfo(), '/admin/products') !== false) {
            $active = 'products';
        }

        return array(
            'active'  => $active,
        );
    }
}
