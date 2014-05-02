<?php

namespace AppAdmin\CategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package AppAdmin\CategoryBundle\Controller
 *
 * @Route("/admin/categories")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_category_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
