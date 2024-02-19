<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use App\Event\ContactEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use  App\Form\ContactType;
use App\Service\HorairesService;

class ContactController extends AbstractController
{

    private HorairesService $horairesService;

    function __construct(HorairesService $horairesService)
    {
        $this->horairesService = $horairesService;  
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, EventDispatcherInterface $dis): Response
    {
        $routeName = $request->attributes->get('_route');
        $page = substr($routeName, strpos($routeName, '_') + 1, strlen($routeName));

        $title = $this->getParameter('app_title_website');
        $listepage = $this->getParameter('app_list_page');

        $horaires = $this->horairesService->fetchHoraires();

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        $contact = new Contact();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $nom = $data->getLastname();
            $prenom = $data->getFirstname();
            $mail = $data->getEmail();
            $message = $data->getMessage();

            $contact->setLastname($nom);
            $contact->setFirstname($prenom);
            $contact->setEmail($mail);
            $contact->setMessage($message);


            //Envoi via l'api vers le server 

            $event = new ContactEvent($nom, $prenom, $mail, $message);

            $dis->dispatch($event);
        }


        return $this->render('contact/index.html.twig', [
            "navitem" => $listepage,
            "page" => $page,
            "title" => $title,
            'contact' => $form,
            "horaires" => $horaires
        ]);
    }
}
