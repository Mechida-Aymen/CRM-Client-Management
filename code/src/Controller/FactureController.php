<?php

namespace App\Controller;

use App\Contract\Service\FactureManagerInterface;
use App\Entity\Facture;
use App\Form\Type\Facture\FactureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class FactureController extends AbstractController
{
     public function __construct(private readonly FactureManagerInterface $factureManager)
     {}

    #[Route('/factures/{id}', name: 'factures_client')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request): Response
    {
        $id = $request->attributes->get('id');

        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 10);

        $pagination = $this->factureManager->findPage( $id,$page, $limit);

        return $this->render('facture/index.html.twig', [
            'factures' => $pagination,
            'owner' => $id
        ]);
    }

    #[Route('/facture/new/{id}', name: 'facture_add')]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, int $id): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->factureManager->create($facture, $id);

            return $this->redirectToRoute('factures_client', ['id' => $id]);
        }

        return $this->render('facture/new.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/facture/edit/{id}', name: 'facture_edit', methods: ['GET', 'POST'])]
    #[IsGranted('EDIT', subject: 'facture')]
    public function edit(Request $request, Facture $facture): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->factureManager->edit($facture);

            return $this->redirectToRoute('factures_client', ['id' => $facture->getOwner()?->getId()]);
        }

        return $this->render('facture/edit.html.twig', [
            'form' => $form,
            'facture' => $facture,
        ]);
    }

    #[Route('/delete/{id}', name: 'facture_delete', methods: ['POST'])]
    #[IsGranted('DELETE', subject: 'facture')]
    public function delete(Request $request, Facture $facture): Response
    {
        if ($this->isCsrfTokenValid('delete' . $facture->getId(), $request->request->get('_token'))) {
            $this->factureManager->delete($facture);
        }

        return $this->redirectToRoute('factures_client', ['id' => $facture->getOwner()?->getId()]);
    }

}
