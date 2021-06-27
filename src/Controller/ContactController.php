<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\EmailModel;
use App\Services\EmailSender;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
   
    /**
     * @Route("/", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request, EmailSender $emailsender): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            // Envoi d'email
            $user = (new User())
                    ->setEmail('aliexprasshop@gmail.com')
                    ->setFirstname('AliExprass')
                    ->setLastname('Shopping');

            $email = (new EmailModel())
                    ->setTitle("Hello ".$user->getFullName())
                    ->setSubject("New contact from your website")
                    ->setContent("<br>From : ".$contact->getEmail()
                                ."<br> Name : ".$contact->getName()
                                ."<br> Subject : ".$contact->getSubject()
                                ."<br><br>".$contact->getContent());
            
            $emailsender->sendEmailNotificationByMailJet($user,$email);


            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
            $this->addFlash('contact_success', 'Your message has been sent. An advisor will answer you very quickly!');
        }

        if($form->isSubmitted() && !$form->isValid()){
            $this->addFlash('contact_error', 'The form contains errors. Please correct and try again.');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

}
