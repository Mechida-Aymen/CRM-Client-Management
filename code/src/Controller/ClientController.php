<?php

namespace App\Controller;

use App\Contract\Repository\ClientRepositoryInterface;
use App\Contract\Service\ClientManagerInterface;
use App\Entity\Client;
use App\Form\Type\Client\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ClientController extends AbstractController
{
     public function __construct(private readonly ClientManagerInterface $clientManager, private readonly Security $security) {}

    #[Route('/clients', name: 'list_clients')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, ClientRepositoryInterface $clientRepository): Response
    {
        $user = $this->getUser();
        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 10);

        $pagination = $clientRepository->findPage($user, $page, $limit);

        
        return $this->render('client/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/client/create', name: 'add_client')]
    #[IsGranted('ROLE_USER')]
    public function create(Request $request): Response
    {
        $client = new Client();
        $user = $this->security->getUser();
        $client->setAuthor($user);
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->clientManager->save($client);
            return $this->redirectToRoute('list_clients');
        }
        return $this->render('client/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/client/edit/{id}', name: 'edit_client')]
    #[IsGranted('EDIT', subject: 'client')]
    public function edit(Request $request, Client $client): Response
    {
        $user = $this->security->getUser();
        $client->setAuthor($user);
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->clientManager->save($client); 
            return $this->redirectToRoute('list_clients');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form,
            'client' => $client,
        ]);
    }

    #[Route('/client/delete/{id}', name: 'delete_client', methods: ['POST'])]
    #[IsGranted('DELETE', subject: 'client')]
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
            $this->clientManager->delete($client); 
        }

        return $this->redirectToRoute('list_clients');
    }
}
