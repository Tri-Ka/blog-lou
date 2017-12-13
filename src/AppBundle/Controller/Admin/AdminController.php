<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
