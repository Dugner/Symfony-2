<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


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
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            //redirect to user list GET
            return $this->redirectToRoute('admin_default');
        }

        return $this->render(
            'Admin/default.html.twig',
            ['user_form' => $form->createView()]
        );
    }

    public function jsonUserList()
    {
        $userRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository(User::class);

        $userList = $userRepository->findAll();

        $serializer = $this->getSerializer();

        return new JsonResponse(
            $serializer->serialize($userList, 'json'),
            200,
            [],
            true
        );
    }
    public function getSerializer() : SerializerInterface
    {
        return $this->get('serializer');
    }


}