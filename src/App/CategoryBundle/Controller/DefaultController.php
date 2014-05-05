<?php

namespace App\CategoryBundle\Controller;

use App\CategoryBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/oferta", name="app_category_index")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'categories' => $this->getRepository()->findBy(array(), array('name' => 'ASC'))
        );
    }

    /**
     * @Route("/oferta/{categoryId}/", name="app_category_show")
     * @ParamConverter("category", class="AppCategoryBundle:Category", options={"id" = "categoryId"})
     * @Template()
     */
    public function showAction(Category $category)
    {
        return array(
            'category' => $category,
            'products' => $category->getProducts(),
        );
    }

    /**
     * @Template()
     */
    public function categoriesListAction(Request $request, Category $category = null)
    {
        return array(
            'categories'       => $this->getRepository()->findBy(array(), array('name' => 'ASC')),
            'selectedCategory' => $category
        );
    }

    /**
     * @return \App\CategoryBundle\Repository\CategoryRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppCategoryBundle:Category');
    }
}
