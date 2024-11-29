<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ParticipantController extends AbstractController
{
    #[Route('/events/{eventId}/participant/new', name: 'add_participant')]
    public function createParticipant(int $eventId, EventRepository $eventRepository, EntityManagerInterface $entityManager, Request $request): Response {
        $event = $eventRepository->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('Événement introuvable.');
        }

        $newParticipant = new Participant();
        $newParticipant->setEvent($event);

        $form = $this->createForm(ParticipantType::class, $newParticipant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newParticipant);
            $entityManager->flush();

            return $this->redirectToRoute('event_details', ['id' => $eventId]);
        }

        return $this->render('participant/new.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }
}
