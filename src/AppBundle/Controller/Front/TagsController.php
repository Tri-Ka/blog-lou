<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class TagsController extends Controller
{
    public function popularAction()
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

        return $this->render('front/tags/popular.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/search-by-tag/{tag}", name="tag_search")
     */
    public function searchAction(Request $request, $tag)
    {
        $articles =  $this->getDoctrine()->getRepository('AppBundle:Article')->findByTag($tag);

        return $this->render('front/search/result.html.twig', [
            'content' => $tag,
            'articles' => $articles,
            'searchType' => 'le tag'
        ]);
    }
}
