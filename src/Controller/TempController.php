<?php

namespace App\Controller;

use App\Entity\Expression;
use App\Entity\SimulationAide;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use App\Resolver\ExpressionResolver;

class TempController extends AbstractController
{
    /**
     * @Route("/test")
     */
    public function test()
    {
        $expressionLanguage = new ExpressionLanguage();
        $result = $expressionLanguage->evaluate('( 1 + 2) * 2');

        dump($result);


        $expression = (new Expression())->setExpression('($MA_VARIABLE === "test")');
        //ExpressionResolver::resolve($expression, new SimulationAide());
        //dump($expression->getExpressionLanguage());
        dump($expression->getExpressionPieces());
        
        return $this->render('app/index.html.twig');
    }
}
