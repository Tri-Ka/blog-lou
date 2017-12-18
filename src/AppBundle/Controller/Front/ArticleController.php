<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class ArticleController extends Controller
{
    public function recentArticlesAction($max = 4)
    {
        return $this->render('front/article/recent.html.twig', [
            'articles' => $this->getDoctrine()->getRepository('AppBundle:Article')->getList(1, 5)
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function showAction(Request $request, Article $article)
    {
        return $this->render('front/article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
