<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\ArticleRepository;

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

        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->getList($page);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($articles) / ArticleRepository::NB_PER_PAGE),
            'nomRoute' => 'homepage',
            'paramsRoute' => array()
        );

        return $this->render('front/default/index.html.twig', [
            'articles' => $articles,
            'tags' => $tags,
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
