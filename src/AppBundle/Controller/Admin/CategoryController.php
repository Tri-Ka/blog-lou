<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Type\CategoryType;
use AppBundle\Entity\Category;

/**
 * @Route("/admin/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/list", name="admin_category_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        return $this->render('admin/category/list.html.twig', [
            'categories' => $this->getDoctrine()->getRepository('AppBundle:Category')->findAll()
        ]);
    }

    /**
     * @Route("/new", name="admin_category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.new.success');

            return $this->redirectToRoute('admin_category_list');
        }

        return $this->render('admin/category/new.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CategoryType::class, $category);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.edit.success');

            return $this->redirectToRoute('admin_category_edit', ['id' => $category->getId()]);
        }

        return $this->render('admin/category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/del/{id}", name="admin_category_del")
     * @Method({"GET"})
     */
    public function delAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'admin.delete.success');

        return $this->redirectToRoute('admin_category_list');
    }
}
