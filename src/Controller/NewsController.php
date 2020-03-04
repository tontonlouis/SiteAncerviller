<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

class NewsController extends AbstractController
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
     * @Route("/News", name="news.index")
     * @return Response
     */
    public function index(): Response
    {
        //// Crée une actualité
        // $event = new Event();
        // $event->setTitle('Hommage')
        //     ->setDescription('Dècés de M. Boulanger')
        //     ->setDateEvent(new \DateTime())
        //     ->setRegister(0)
        //     ->setTypeEvent(1);

        //// Persist l'événement en base de donnée
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($event);
        // $em->flush();

        // Récupére tous les événements
        $events = $this->repository->findAllNews();

        // Rénvoi la page index des événements
        return $this->render('news/index.html.twig',[
            'current_menu' => 'news',
            'events' => $events
        ]);
    }

     /**
     * @Route("/News/{slug}-{id}", name="news.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Event $event, string $slug) : Response
    {
        if ($slug !== $event->getSlug()) {
            return $this->redirectToRoute('news.show', [
                'id' => $event->getId(),
                'slug' => $event->getSlug()
            ],301);
        }
            return $this->render('news/show.html.twig', [
                'current_menu' => 'news',
                'event' => $event
            ]);
        
    }
  
}
