<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    /**
     * @Route("/{page}", name="homepage", defaults={"page" = 1})
     */
    public function indexAction(Request $request, $page)
    {
        $tags = [];
        $articles =  $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();

        foreach ($articles as $article) {
            $articleTags = explode('#', $article->getHtags());

            foreach ($articleTags as $articleTag) {
                $articleTag = trim($articleTag);
                if ('' !== $articleTag) {
                    $tags[$articleTag] = '#'.$articleTag;
                }
            }
        }

        return $this->render('front/default/index.html.twig', [
            'articles' => $this->getDoctrine()->getRepository('AppBundle:Article')->getList($page),
            'tags' => $tags,
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
