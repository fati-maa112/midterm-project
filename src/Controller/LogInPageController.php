<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LogInPageController extends AbstractController
{
    #[Route('/log/in', name: 'app_log_in_page')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('log_in_page/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
