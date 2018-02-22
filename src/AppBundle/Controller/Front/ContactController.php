<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Type\ContactType;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);

        if ($form->handleRequest($request)->isValid()) {
            $data = $form->getData();

            $message = (new \Swift_Message('Contact email'))
                ->setFrom('contact@blog.com')
                ->setTo($this->getParameter('mailer_user'))
                ->setBody(
                    $this->renderView(
                        'front/emails/contact.html.twig',
                        ['data' => $data]
                    ),
                    'text/html'
                );

            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add('notice', 'contact.new.success');
            return $this->redirectToRoute('contact');
        }

        return $this->render('front/contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
