<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'event_list')]
    public function showEvents(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        return $this->render('event/list.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/event/{id}', name:'event_details', requirements: ['id' => '\d+'])]
    public function showEvent (int $id, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->find($id);

        if(!$event){
            throw $this->createNotFoundException("Évènement non trouvé.");
        }

        return $this->render('event/view.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/events/{id}/delete', name: 'event_delete')]
    public function deleteEvent(int $id, EventRepository $eventRepository, EntityManagerInterface $entityManager): Response
    {
        $event = $eventRepository->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Événement introuvable.');
        }

        // Supprimer l'événement
        $entityManager->remove($event);
        $entityManager->flush();

        $this->addFlash('success', 'Événement supprimé avec succès.');

        return $this->redirectToRoute('event_list');
    }

    #[Route('/events/new', name: 'add_event')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newEvent = new Event();

        $form = $this->createForm(EventType::class, $newEvent);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newEvent);
            $entityManager->flush();

            return $this->redirectToRoute('event_list');
        }

        return $this->render('event/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
