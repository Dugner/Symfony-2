<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProjectFormType;
use App\Entity\Project;

class ProjectController extends Controller
{
   
    public function projectTable(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $project = new Project();
        $form = $this->createForm(

            ProjectFormType::class,
            $project,
            ['standalone' => true]
        );
        
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             //inset the data if the post is valid
             $manager->persist($project);
             $manager->flush();

             //redirect to user list GET
             return $this->redirectToRoute('project_list');
         }

        return $this->render(
            'Project/list.html.twig',
            ['projects' => $manager->getRepository(Project::class)->findAll(),
            'project_list'=> $form->createView()]
        );
    }
}

