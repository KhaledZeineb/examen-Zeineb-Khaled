<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ProductRepository $productRepository): Response
    {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        // Récupérer les products pour les afficher dans le dashboard
        $products = $productRepository->findAll();
        
        return $this->render('dashboard/index.html.twig', [
            'products' => $products,
        ]);
    }
}