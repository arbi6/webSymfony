<?php

namespace CompBundle\Controller;
use CompBundle\Form\PostType;
use CompBundle\Entity\Post;
use CompBundle\Entity\Postcomments;
use CompBundle\Repository\PostcommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Security\Core\User\UserInterface;
use  Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class BlogController extends Controller
{
    public function addAction(Request $request)
    {
        $post=new Post();
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $file=$post->getPhoto();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$filename);
            $post->setPhoto($filename);
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('affiche_homepage');
        }
        return $this->render("@Comp/Event/add.html.twig",array('form'=>$form->createView()));
    }

    public function add_mobileAction(Request $request)
    {
        $post=new Post();
        $desc = $request->get("desc");
        $tt = $request->get("title");
        $photo = $request->get("photo");
        $postdate = new \DateTime( $request->get("postdate") );
        $getdate = new \DateTime( $request->get("getdate") );

        $em=$this->getDoctrine()->getManager();
        $post->setTitle($tt);
        $post->setPhoto($photo);
        $post->setDescription($desc);
        $post->setPostdate($postdate);
        $post->setGetdate($getdate);

        $em->persist($post);
        $em->flush();

        return new Response($post->getId());
    }

    public function addImageAction(Request $req, $id){
        if ($req->isMethod("post")) {
            $dossier = $this->getParameter('kernel.project_dir') . "/web/uploads/images/";
            $orm = $this->getDoctrine()->getManager();
            $repos = $orm->getRepository('CompBundle:Post');
            $event = $repos->find($id);
            if($event) {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $file_name = uniqid(). "." . $ext;
                $file_tmp = $_FILES['file']['tmp_name'];
                if (move_uploaded_file($file_tmp, $dossier . $file_name)) {
                    $event->setPhoto($file_name);
                    $orm->flush();
                }
                return new Response("yes");
            }
        }
        throw new NotFoundHttpException();
    }

    public function get_imageAction($image){
        $path = $this->getParameter('kernel.project_dir') . "/web/uploads/images/".$image ;
        $r = new BinaryFileResponse($path);
        $r->headers->set("Content-Type","image/png");
        $r->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE);
        return $r;
    }

    public function listAction(Request $request){
   //     $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository("CompBundle:Post")->findAll();
        return $this->render("@Comp/Event/afficher.html.twig",array('posts'=>$posts));
    }

    public function list_mobileAction(Request $request){

        $encoders = [new JsonEncoder()];
        $norm = new ObjectNormalizer();
        $norm->setCircularReferenceLimit(2);
        $norm->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = [$norm];
        $serializer = new Serializer($normalizers, $encoders);

        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository("CompBundle:Post")->findAll();
        $att= array("attributes"=>["id","title","description","photo", "comments.id","comments"=>["content","user"=>["id","fullName"]]]);
        return new Response($serializer->serialize($posts, "json", $att));
    }

    public function updateAction(Request $request ,$id){
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository("CompBundle:Post")->find($id);
        $form= $this->createForm(PostType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file =$p->getPhoto();
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$filename);
            $p->setphoto($filename);
            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
            $this->addFlash('info','create');
        }
        return $this->render("@Comp/Event/update.html.twig",array('form'=>$form->createView()));
    }

    public function update_mobileAction(Request $request ,$id){
        $em=$this->getDoctrine()->getManager();
        $post= $em->getRepository("CompBundle:Post")->find($id);

        $desc = $request->get("desc");
        $tt = $request->get("title");
        $photo = $request->get("photo");
        $postdate = new \DateTime( $request->get("postdate") );
        $getdate = new \DateTime( $request->get("getdate") );

        $post->setTitle($tt);
        $post->setPhoto($photo);
        $post->setDescription($desc);
        $post->setPostdate($postdate);
        $post->setGetdate($getdate);

        $em->flush();

        return new Response("1");
    }


    public function connexionAction(Request $req){
        $orm= $this->getDoctrine()->getManager();
        $user = $orm->getRepository('CompBundle:Users')
            ->findOneBy(array("username"=>$req->query->get("username")));
        if ($user){
            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            if ($encoder->isPasswordValid($user->getPassword(), $req->query->get("password"), $user->getSalt())){
                $encoders = [new JsonEncoder()];
                $normalizers = [new ObjectNormalizer()];
                $serializer = new Serializer($normalizers,$encoders);
                return new JsonResponse($serializer->normalize($user, 'json',
                    array("attributes"=>["id","username","email", "nomPrenom", "adresse", "numeroTel"]) ));
            }
        }

        return new Response("no");
    }


 public function deleteAction(Request $request){
        $id = $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $post=$em->getRepository('CompBundle:Post')->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute(('affiche_homepage'));
 }

    public function delete_mobileAction(Request $request, $id){
        $em= $this->getDoctrine()->getManager();
        $post=$em->getRepository('CompBundle:Post')->find($id);
        $comm= $em->getRepository('CompBundle:Postcomments')->findBy(array("post"=>$post));
        foreach ($comm as $c)
            $em->remove($c);
        $em->remove($post);
        $em->flush();
        return new Response("yes");
    }

 public function showAction($id){
        $em= $this->getDoctrine()->getManager();
        $p=$em->getRepository('CompBundle:Post')->find($id);

        $comments = $p->getComments();
        return $this->render("@Comp/Event/detail.html.twig",array(
            'title'=>$p->getTitle(),
            'description'=>$p->getDescription(),
            'photo'=>$p->getPhoto(),
            'getdate'=>$p->getGetdate(),
            'postdate'=>$p->getPostdate(),
            'id'=>$p->getId(),
            'p'=>$p


        ));


    }

    public function show_mobileAction($id){
        $em= $this->getDoctrine()->getManager();
        $p=$em->getRepository('CompBundle:Post')->find($id);

        $encoders = [new JsonEncoder()];
        $norm = new ObjectNormalizer();
        $normalizers = [$norm];
        $serializer = new Serializer($normalizers, $encoders);

        $att = array("attributes"=>["title","description","photo","comments"=>["content","user"=>["id","username"]]]);
        return new Response($serializer->serialize($p,"json",$att));

    }

 public function addCommentAction(Request $request,UserInterface $user,$id){
        $ref = $request->headers->get('referer');

        $emr = $this->getDoctrine()->getManager();
          $p=$emr->getRepository('CompBundle:Post')
            ->find($id);

        $comment =new Postcomments();
        $comment->setUser($user);
        $comment->setPost($p);
        $comment->setPostAt(new \DateTime('now'));
        $comment->setContent($request->request->get('comment'));
        $em=$this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        $this->addFlash('info', 'comment published');
       return $this->redirect($ref);
 }


     public function addComment_mobileAction(Request $request, $user, $p){
         $em = $this->getDoctrine()->getManager();
         $p=$em->getRepository('CompBundle:Post')->find($p);
         $user =   $em->getRepository('CompBundle:Users')->find($user);

         $comment =new Postcomments();
         $comment->setUser($user);
         $comment->setPost($p);
         $comment->setPostAt(new \DateTime('now'));
         $comment->setContent($request->query->get('comment'));

         $em->persist($comment);
         $em->flush();

         return new Response("yeees");
     }

//public Post getPostById($id)
}
