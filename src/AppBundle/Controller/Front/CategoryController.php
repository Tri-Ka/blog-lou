<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Entity\Category;

class CategoryController extends Controller
{

    /**
     * @Route("/search-by-category/{id}", name="category_search")
     */
    public function searchAction(Request $request, Category $category)
    {
        $articles =  $this->getDoctrine()->getRepository('AppBundle:Article')->findByCategory($category->getId());

        return $this->render('front/search/result.html.twig', [
            'content' => $category->getName(),
            'articles' => $articles,
            'searchType' => 'la categorie'
        ]);
    }
}
