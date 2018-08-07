<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProjectController
{
   
    private $twig;

    public function __construct(
        \Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }
    
    public function listProjects()
    {
        return new Response(
            $this->twig->render(
                'Project/list.html.twig',
                ['projects' => []]
            )
        );
    }
}

