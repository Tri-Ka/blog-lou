<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TagsController extends Controller
{
    public function popularAction()
    {
        return $this->render('front/tags/popular.html.twig', [
            'tags' => $this->getDoctrine()->getRepository('AppBundle:Tag')->findPopular(),
        ]);
    }

    /**
     * @Route("/search-by-tag/{tag}", name="tag_search")
     */
    public function searchAction(Request $request, Tag $tag)
    {
        $articles =  $this->getDoctrine()->getRepository('AppBundle:Article')->findByTag($tag);

        return $this->render('front/search/result.html.twig', [
            'content' => $tag,
            'articles' => $articles,
            'searchType' => 'le tag'
        ]);
    }
}
