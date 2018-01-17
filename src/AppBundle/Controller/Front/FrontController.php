<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\ArticleRepository;

class FrontController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $page = null === $request->query->get('page') ? 1 : $request->query->get('page');
        $categories =  $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->getList($page);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($articles) / ArticleRepository::NB_PER_PAGE),
            'nomRoute' => 'homepage',
            'paramsRoute' => array()
        );

        return $this->render('front/default/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/demo", name="demo")
     */
    public function demoAction(Request $request)
    {
        return $this->render('front/default/demo.html.twig');
    }
}
