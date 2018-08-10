<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Document;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class DefaultController extends Controller
{
    public function homepage()
    {
        return $this->render('default/homepage.html.twig');
    }

    public function login(AuthenticationUtils $authUtils)
    {
        //get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        //last username entraded by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render(

            'Default/login.html.twig', array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    public function downloadDocument(Document $document)
    {
        $fileName = sprintf(
            '%s/%s',
            $document->getPath(),
            $document->getName()
        );
        return new BinaryFileResponse($fileName);
    }
}







