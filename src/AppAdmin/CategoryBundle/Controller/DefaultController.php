<?php

namespace AppAdmin\CategoryBundle\Controller;

use App\CategoryBundle\Entity\Category;
use AppAdmin\CategoryBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

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
        return array(
            'categories' => $this->getRepository()->findBy(array(), array('name' => 'ASC'))
        );
    }

    /**
     * @Route("/new", name="admin_category_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(new CategoryType());

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $data = $form->getData();

                $this->getDoctrine()->getManager()->persist($data);
                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add('success', 'Dane zapisano poprawnie.');
                return $this->redirect($this->generateUrl('admin_category_index'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{categoryId}/edit", name="admin_category_edit")
     * @ParamConverter("category", class="AppCategoryBundle:Category", options={"id" = "categoryId"})
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Category $category)
    {
        $form = $this->createForm(new CategoryType(), $category);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $data = $form->getData();

                $this->getDoctrine()->getManager()->persist($data);
                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add('success', 'Dane zapisano poprawnie.');
                return $this->redirect($this->generateUrl('admin_category_index'));
            }
        }

        return array(
            'form'     => $form->createView(),
            'category' => $category
        );
    }

    /**
     * @Route("/{categoryId}/delete", name="admin_category_delete")
     * @ParamConverter("category", class="AppCategoryBundle:Category", options={"id" = "categoryId"})
     */
    public function deleteAction(Category $category)
    {
        $this->getDoctrine()->getManager()->remove($category);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->add('success', 'Kategoria została usunięta.');
        return $this->redirect($this->generateUrl('admin_category_index'));
    }

    /**
     * @return \App\CategoryBundle\Repository\CategoryRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppCategoryBundle:Category');
    }
}
