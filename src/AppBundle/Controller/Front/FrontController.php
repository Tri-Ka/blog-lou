<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('front/default/index.html.twig');
    }

    /**
     * @Route("/demo", name="demo")
     */
    public function demoAction(Request $request)
    {
        return $this->render('front/default/demo.html.twig');
    }
}
