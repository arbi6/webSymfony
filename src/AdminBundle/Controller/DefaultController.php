<?php

namespace AdminBundle\Controller;

use CompBundle\Form\PostType;
use src\CompBundle\Entity\Post;
use CompBundle\Entity\Postcomments;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function listAction(Request $request){
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository("CompBundle:Post")->findAll();
        return $this->render("@Admin/User/Admin.html.twig",array('posts'=>$posts));
}



}
