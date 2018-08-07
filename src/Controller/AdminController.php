<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


Class AdminController extends Controller
{

    public function default(Request $request)
    {
        $user = new User();
        $form = $this->createForm(

            UserFormType::class,
            $user,
            ['standalone' => true]
        );
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //inset the data if the post is valid
            //redirect to user list GET

        }

        return $this->render(
            'Admin/default.html.twig',
            ['user_form' => $form->createView()]
        );
    }



}