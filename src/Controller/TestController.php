<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Expression;
use App\Repository\DispositifRepository;
use App\Repository\OffreRepository;
use App\Resolver\ExpressionResolver;
use App\Resolver\ExpressionResolverData;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(): Response
    {
        $expression = (new Expression())->setExpression('(2 + 1) * $VARIABLE_1 * ($VARIABLE_2 + $VARIABLE_3)');
        dump($expression->getExpressionLanguage(), $expression->getExpressionVariables());
        
        $response = ExpressionResolver::resolve($expression, new ExpressionResolverData());

        dump($expression, $response);

        return $this->render('app/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/repository', name: 'repository')]
    public function repository(DispositifRepository $resository): Response
    {
        $collection = $resository->findAllAvailable(8, ["76"], [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        dump($collection);

        return $this->render('app/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

}
