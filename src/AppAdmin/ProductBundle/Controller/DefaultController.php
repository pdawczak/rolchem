<?php

namespace AppAdmin\ProductBundle\Controller;

use App\ProductBundle\Entity\Product;
use AppAdmin\ProductBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/products")
 *
 * Class DefaultController
 * @package AppAdmin\ProductBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_product_index")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'products' => $this->getRepository()->findBy(array(), array('name' => 'ASC'))
        );
    }

    /**
     * @Route("/new", name="admin_product_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(new ProductType());

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $data = $form->getData();

                $this->getDoctrine()->getManager()->persist($data);
                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add('success', 'Dane zapisano poprawnie.');
                return $this->redirect($this->generateUrl('admin_product_index'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{productId}/edit", name="admin_product_edit")
     * @ParamConverter("product", class="AppProductBundle:Product", options={"id" = "productId"})
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Product $product)
    {
        $form = $this->createForm(new ProductType(), $product);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $data = $form->getData();

                $this->getDoctrine()->getManager()->persist($data);
                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add('success', 'Dane zapisano poprawnie.');
                return $this->redirect($this->generateUrl('admin_product_index'));
            }
        }

        return array(
            'form'    => $form->createView(),
            'product' => $product
        );
    }

    /**
     * @Route("/{productId}/delete", name="admin_product_delete")
     * @ParamConverter("product", class="AppProductBundle:Product", options={"id" = "productId"})
     */
    public function deleteAction(Product $product)
    {
        $this->getDoctrine()->getManager()->remove($product);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->add('success', 'Produkt został usunięty.');
        return $this->redirect($this->generateUrl('admin_product_index'));
    }

    /**
     * @return \App\ProductBundle\Repository\ProductRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppProductBundle:Product');
    }
}
