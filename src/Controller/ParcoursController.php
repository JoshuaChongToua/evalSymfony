<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Form\ParcoursForm;
use App\Repository\EtapeRepository;
use App\Repository\MessageRepository;
use App\Repository\ParcoursRepository;
use App\Repository\RenduRepository;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parcours')]
final class ParcoursController extends AbstractController
{
    #[Route(name: 'app_parcours_index', methods: ['GET'])]
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        return $this->render('parcours/index.html.twig', [
            'parcours' => $parcoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parcours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parcour = new Parcours();
        $form = $this->createForm(ParcoursForm::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parcour);
            $entityManager->flush();

            return $this->redirectToRoute('app_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parcours/new.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parcours_show', methods: ['GET'])]
    public function show(Parcours $parcour): Response
    {
        return $this->render('parcours/show.html.twig', [
            'parcour' => $parcour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parcours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parcours $parcour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParcoursForm::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parcours/edit.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parcours_delete', methods: ['POST'])]
    public function delete(Request $request, Parcours $parcour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcour->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parcour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parcours_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/etapes', name: 'app_show_etape', methods: ['GET'])]
    public function showEtape(Parcours $parcours, EtapeRepository $etapeRepository, MessageRepository $messageRepository, RessourceRepository $ressourceRepository, RenduRepository $renduRepository): Response
    {
        $etapes = $etapeRepository->findBy(['parcours' => $parcours]);
        $rendusUser = $renduRepository->findBy(['user_id' => $this->getUser()]);
        $rendusParEtape = [];
        foreach ($rendusUser as $rendu) {
            foreach ($rendu->getEtapes() as $etape) {
                $rendusParEtape[$etape->getId()][] = $rendu;
            }
        }
        $ressources = $ressourceRepository->findBy(['etape' => $etapes]);
        $messages = $messageRepository->findAll();
//dd($messages);
//        dd($rendusParEtape);
        return $this->render('etape/showEtapeParcours.html.twig', [
            'messages' => $messages,
            'rendusParEtape' => $rendusParEtape,
            'ressources' => $ressources,
            'parcours' => $parcours,
            'etapes' => $etapes,
        ]);
    }
}
