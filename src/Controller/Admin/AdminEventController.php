<?php

namespace App\Controller\Admin;

use App\Repository\EventRepository;
use App\Entity\Event;
use App\Form\EventType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;



class AdminEventController extends AbstractController
{

    /**
     * @var EventRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var EventRepository
     */
    public function __construct(EventRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.event.index")
     * @return Response
     */
    public function index(): Response
    {
        $events = $this->repository->findAll();
        return $this->render('admin/event/index.html.twig', compact('events'));

        
    }

    /**
     * @Route("/admin/event/{slug}-{id}", name="admin.event.edit", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function edit(Event $event, Request $request) : Response
    {
        $event = $this->repository->find($event->getId());
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/event/edit.html.twig',[
            'event' => $event,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/event/new", name="admin.event.new")
     * @return Response
     */
    public function new(Request $request) : Response 
    {

        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($event);
            $this->em->flush();
            return $this->redirectToRoute('admin.event.index');
        }

        return $this->render('admin/event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/admin/event/{id}", name="admin.event.delete", methods="DELETE")
    * @param Event $event
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\RedirectResponse
    */
    public function delete(Event $event, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $event->getId(), $request->get('_token'))){
            $this->em->remove($event);
            $this->em->flush();
        }

        return $this->redirectToRoute('admin.event.index');
    }

}
