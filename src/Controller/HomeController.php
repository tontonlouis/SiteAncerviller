<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class HomeController extends AbstractController
{
     /**
     * @var EventRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(EventRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(EventRepository $repository) : Response
    {
        $events = $repository->findLatest();
            
        return $this->render('pages/home.html.twig',[
            'events' => $events
        ]);
    }

    /**
     * @Route("/Contact", name="contact")
     * @return Response
     */
    public function contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);


        return $this->render('contact/index.html.twig',[
            'current_menu' => 'contact',
            'form' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/Horaire", name="horaire")
     * @return Response
     */
    public function horaire(): Response
    {
        return $this->render('horaire/index.html.twig',[
            'current_menu' => 'horaire'
        ]);
    }

    /**
     * @Route("/Ecole", name="school")
     * @return Response
     */
    public function school(): Response
    {
        
        $events = $this->repository->findAllSchool();

        return $this->render('school/index.html.twig',[
            'current_menu' => 'school',
            'events' => $events
        ]); 
    }
}
