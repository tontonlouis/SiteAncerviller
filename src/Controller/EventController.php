<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

class EventController extends AbstractController
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
     * @Route("/Events", name="event.index")
     * @return Response
     */
    public function index(): Response
    {
        // // Crée un événement
        // $event = new Event();
        // $event->setTitle('Vacances d\'hiver')
        //     ->setDescription('L\'école sera fermer du 22 décembre 2018 au 7 janvier 2019')
        //     ->setDateEvent(new \DateTime())
        //     ->setRegister(0)
        //     ->setTypeEvent(2);

        // // Persist l'événement en base de donnée
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($event);
        // $em->flush();

        // Récupére tous les événements
        $events = $this->repository->findAllEvent();

        // Rénvoi la page index des événements
        return $this->render('event/index.html.twig',[
            'current_menu' => 'events',
            'events' => $events
        ]);
    }

     /**
     * @Route("/Events/{slug}-{id}", name="event.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Event $event, string $slug) : Response
    {
        if ($slug !== $event->getSlug()) {
            return $this->redirectToRoute('event.show', [
                'id' => $event->getId(),
                'slug' => $event->getSlug()
            ],301);
        }
            return $this->render('event/show.html.twig', [
                'current_menu' => 'events',
                'event' => $event
            ]);
        
    }
  
}
