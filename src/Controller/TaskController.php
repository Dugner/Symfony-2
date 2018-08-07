<?php

namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{

    private $twig;
    
    public function __construct(
        \Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }
    
    public function listTasks()
    {
        return new Response(
            $this->twig->render(
                'task/list.html.twig',
                ['tasks' => []]
            )
        );
    }
    
    public function taskDetail(Request $request)
    {
        $id = $request->query->get('id');
        
        if (!$id) {
            throw new NotFoundHttpException();
        }
        
        $tasks = [];
        if (!isset($tasks[$id])) {
            throw new NotFoundHttpException();
        }
        
        return new Response(
            $this->twig->render(
                'task/detail.html.twig',
                ['task'=>$tasks[$id]]
            )
        );
    }
}
