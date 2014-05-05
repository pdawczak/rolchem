<?php

namespace App\ProductBundle\Controller;

use App\CategoryBundle\Entity\Category;
use App\ProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/oferta/{categoryId}/{productId}/", name="app_product_show")
     * @ParamConverter("category", class="AppCategoryBundle:Category", options={"id" = "categoryId"})
     * @ParamConverter("product", class="AppProductBundle:Product", options={"id" = "productId"})
     * @Template()
     */
    public function showAction(Category $category, Product $product)
    {
        return array(
            'product' => $product
        );
    }
}
