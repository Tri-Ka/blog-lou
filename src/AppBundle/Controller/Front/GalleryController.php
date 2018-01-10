<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\PictureRepository;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     */
    public function indexAction(Request $request)
    {
        $page = null === $request->query->get('page') ? 1 : $request->query->get('page');
        $pictures = $this->getDoctrine()->getRepository('AppBundle:Picture')->getList($page);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($pictures) / PictureRepository::NB_PER_PAGE),
            'nomRoute' => 'gallery',
            'paramsRoute' => array()
        );

        return $this->render('front/gallery/gallery.html.twig', [
            'pictures' => $pictures,
            'pagination' => $pagination
        ]);
    }
}
