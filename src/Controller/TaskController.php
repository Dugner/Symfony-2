<?php

namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Task;
use App\Form\TaskFormType;
use App\DTO\TaskSearch;
use App\Form\TaskSearchFormType;

class TaskController extends Controller
{
    public function listTasks(Request $request)
    {
        
        $manager = $this->getDoctrine()->getManager();
        $task = new Task();
        $form = $this->createForm(

            TaskFormType::class,
            $task,
            ['standalone' => true]
        );

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($task);
            $manager->flush();

            return $this->redirectToRoute("task_list");
        }

        $dto = new TaskSearch();
        $searchForm = $this->createForm(TaskSearchFormType::class, $dto, ['standalone' => true]);

        $searchForm -> handleRequest($request);
    
        $task = $manager->getRepository(Task::class)->findByTaskSearch($dto);
     

        return $this->render(
            'task/list.html.twig',
            [
                'tasks' => $task,
                'task_form' => $form->createView(),
                'searchForm' => $searchForm->createView()
            ]
            
        );
    }
    
    public function taskDetail(Task $task, Request $request)
    {
        $form = $this->createForm(TaskFormType::class, $task, ['standalone' => true]);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid())    {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_detail', ['task' => $task->getId()]);
        }
        
        return $this->render(
            'task/detail.html.twig',
            ['task'=> $task,
            'form' => $form->createView()]
        );
        
    }
}
