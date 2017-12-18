<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->render('admin/default/index.html.twig');
    }

    /**
     * @Route("/demo", name="admin_demo")
     * @Method({"GET"})
     */
    public function demoAction()
    {
        return $this->render('admin/demo.html.twig');
    }

    /**
     * @Route("/settings/logo", name="logo")
     * @Method({"GET", "POST"})
     */
    public function updateLogoAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('logo', FileType::class, [
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/png',
                            'image/gif',
                            'image/jpeg',
                        ],
                    ]),
                ],
            ])
            ->getForm();

        if ($request->isMethod('post')) {
            if ($form->handleRequest($request)->isValid()) {
                $this->get('app.logo.service')->saveLogo($form->getData());
            } else {
                $this->get('session')->getFlashBag()->add('error', 'admin.logo.update.error');
            }

            return $this->redirectToRoute('dmishh_settings_manage_global');
        }

        return $this->render('admin/setting/logo.html.twig', array(
          'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/settings/logo-delete", name="logo_delete")
     * @Method({"GET"})
     */
    public function deleteLogoAction()
    {
        $this->get('app.logo.service')->deleteLogo();
        $this->get('session')->getFlashBag()->add('notice', 'admin.logo.delete.success');

        return $this->redirectToRoute('dmishh_settings_manage_global');
    }

    /**
     * @Route("/settings/cover", name="cover")
     * @Method({"GET", "POST"})
     */
    public function updateCoverAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('cover', FileType::class, [
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/png',
                            'image/gif',
                            'image/jpeg',
                        ],
                    ]),
                ],
            ])
            ->getForm();

        if ($request->isMethod('post')) {
            if ($form->handleRequest($request)->isValid()) {
                $this->get('app.cover.service')->saveCover($form->getData());
            } else {
                $this->get('session')->getFlashBag()->add('error', 'admin.cover.update.error');
            }

            return $this->redirectToRoute('dmishh_settings_manage_global');
        }

        return $this->render('admin/setting/cover.html.twig', array(
          'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/settings/cover-delete", name="cover_delete")
     * @Method({"GET"})
     */
    public function deleteCoverAction()
    {
        $this->get('app.cover.service')->deleteCover();
        $this->get('session')->getFlashBag()->add('notice', 'admin.cover.delete.success');

        return $this->redirectToRoute('dmishh_settings_manage_global');
    }
}
