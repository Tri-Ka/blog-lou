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
            'lastArticles' => $this->getDoctrine()->getRepository('AppBundle:Article')->findAll(),
            'articles' => $this->getDoctrine()->getRepository('AppBundle:Article')->findAll(),
            'tags' => $tags,
            'popularTags' => $tags
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
