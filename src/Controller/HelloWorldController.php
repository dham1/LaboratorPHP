<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\HelloWorld;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldController extends AbstractController
{
    /**
     * @Route("/helloworld", name="create_HelloWorld")
     */
    public function createHelloWorld(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $helloworld = new HelloWorld();
        $helloworld->setText("Hello world, it's Diana");
        
        $entityManager->persist($helloworld);

        $entityManager->flush();

        return new Response('Saved new hellowolrd with id' .$helloworld->getId());
    }

    /**
     * @Route("/helloworld/{id}", name="helloworld_show")
     */
    public function show($id)
    {
        $helloworld = $this->getDoctrine()
            ->getRepository(HelloWorld::class)
            ->find($id);
        if(!$helloworld){
            throw $this->createNotFoundException(
                'No helloworld found for id' .$id
            );
        }
        return new Response('<h1>'.$helloworld->getText());
    }
}
