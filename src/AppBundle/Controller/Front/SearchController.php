<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SearchController extends Controller
{
    /**
     * @Route("/search-by-content/", name="content_search")
     * @Method({"POST"})
     */
    public function searchAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('content', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $datas = $request->request->get('form');
            $articles =  $this->getDoctrine()->getRepository('AppBundle:Article')->findByContent($datas['content']);

            return $this->render('front/search/result.html.twig', [
                'content' => $datas['content'],
                'articles' => $articles,
            ]);
        }

        return $this->render('front/search/search.html.twig', array('form' => $form->createView()));
    }
}
