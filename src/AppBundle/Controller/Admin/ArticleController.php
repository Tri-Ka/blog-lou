<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Type\ArticleType;
use AppBundle\Entity\Article;

/**
 * @Route("/admin/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/list", name="admin_article_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        return $this->render('admin/article/list.html.twig', [
            'articles' => $this->getDoctrine()->getRepository('AppBundle:Article')->findAll()
        ]);
    }

    /**
     * @Route("/new", name="admin_article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        if ($form->handleRequest($request)->isValid()) {
            $article->setCreatedAt(new \DateTime());
            $em->persist($article);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.new.success');

            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('admin/article/new.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_article_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ArticleType::class, $article);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($article);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'admin.edit.success');

            return $this->redirectToRoute('admin_article_edit', ['id' => $article->getId()]);
        }

        return $this->render('admin/article/edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
     * @Route("/del/{id}", name="admin_article_del")
     * @Method({"GET"})
     */
    public function delAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'admin.delete.success');

        return $this->redirectToRoute('admin_article_list');
    }
}
