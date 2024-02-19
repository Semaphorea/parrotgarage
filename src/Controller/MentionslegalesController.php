<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\HorairesService;

class MentionslegalesController extends AbstractController
{

    private HorairesService $horairesService;

    function __construct(HorairesService $horairesService)
    {
        $this->horairesService = $horairesService;
    }

    #[Route('/mentionslegales', name: 'app_mentionslegales')]
    public function index(Request $request): Response
    {
        $routeName = $request->attributes->get('_route');
        $page = substr($routeName, strpos($routeName, '_') + 1, strlen($routeName));

        $title = $this->getParameter('app_title_website');
        $listepage = $this->getParameter('app_list_page');
        $horaires = $this->horairesService->fetchHoraires();
        return $this->render('mentionslegales/index.html.twig', [
            "navitem" => $listepage,
            "page" => $page,
            "title" => $title,
            "horaires" => $horaires
        ]);
    }
}
