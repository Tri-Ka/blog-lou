<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Type\PictureType;
use AppBundle\Entity\Picture;

/**
 * @Route("/admin/picture")
 */
class PictureController extends Controller
{
    /**
     * @Route("/list", name="admin_picture_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        return $this->render('admin/picture/list.html.twig', [
            'pictures' => $this->getDoctrine()->getRepository('AppBundle:Picture')->findAll()
        ]);
    }

    /**
     * @Route("/new", name="admin_picture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $picture = new Picture();

        $form = $this->createForm(PictureType::class, $picture);

        if ($form->handleRequest($request)->isValid()) {
            $picture->setCreatedAt(new \DateTime());
            $em->persist($picture);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.new.success');

            return $this->redirectToRoute('admin_picture_list');
        }

        return $this->render('admin/picture/new.html.twig', [
            'form' => $form->createView(),
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_picture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Picture $picture)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(PictureType::class, $picture);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($picture);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.edit.success');

            return $this->redirectToRoute('admin_picture_edit', ['id' => $picture->getId()]);
        }

        return $this->render('admin/picture/edit.html.twig', [
            'form' => $form->createView(),
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/del/{id}", name="admin_picture_del")
     * @Method({"GET"})
     */
    public function delAction(Picture $picture)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($picture);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'admin.delete.success');

        return $this->redirectToRoute('admin_picture_list');
    }
}
