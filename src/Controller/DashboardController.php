<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        OrderRepository $orderRepo,
        ProductRepository $productRepo
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Count total orders and products
        $totalOrders = $orderRepo->count([]);
        $totalProducts = $productRepo->count([]);

        // Optional: get last 5 orders for table
        $recentOrders = $orderRepo->findBy([], ['id' => 'DESC'], 5);

        return $this->render('dashboard/index.html.twig', [
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'recentOrders' => $recentOrders,
        ]);
    }
}
