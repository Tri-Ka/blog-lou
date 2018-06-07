<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Type\UserType;
use AppBundle\Entity\User;

/**
 * @Route("/admin/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/list", name="admin_user_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        return $this->render('admin/user/list.html.twig', [
            'users' => $this->getDoctrine()->getRepository('AppBundle:User')->findAll()
        ]);
    }

    /**
     * @Route("/new", name="admin_user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.new.success');

            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin/user/new.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(UserType::class, $user);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.edit.success');

            return $this->redirectToRoute('admin_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/del/{id}", name="admin_user_del")
     * @Method({"GET"})
     */
    public function delAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'admin.delete.success');

        return $this->redirectToRoute('admin_user_list');
    }
}
