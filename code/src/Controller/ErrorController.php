<?php

// src/Controller/ErrorController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/not-found', name: 'custom_404')]
    public function notFound(): Response
    {
        return $this->render('custom_404.html.twig');
    }
}
