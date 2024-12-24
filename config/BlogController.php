<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="app_blog")
     */
    public function index(): Response
    {   
        $repo=$this->getDoctrine()->getRepository(Article::class);
        $articles=$repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController','articles'=>$articles
        ]);
    }
       /**
     * @route("/",name="home")
     */
    public function home(){
        return $this->render('blog/home.html.twig',['title'=>'bienvenu ','age'=>12]);
    }


    /**
     * @route("/blog/new",name="blog_create")
   
     *  @route("/blog/{id}/edit",name="blog_edit")
    
     */
    public function form(Article $article=null,Request $request,ObjectManager $manage){

       if(!$article){
            $article=new Article();
       }
        /*$form=$this->createFormBuilder($article)->add('title' )
            ->add('content' )
            ->add('image')
            ->getForm();
            */
        $form=$this->createForm(ArticleType::class,$article);
        
        $form->handleRequest($request);  
 
        if($form->isSubmitted()&& $form->isValid()){
            if(!$article->getId()){
                $article->setCreateAt(new \DateTimeImmutable());
            }
    
            $manage->persist($article);
            $manage->flush();
            return $this->redirectToRoute('blog_show',['id'=>$article->getId()]);
        }
        
        return $this->render('blog/create.html.twig',['formArticle'=>$form->createView(),"editMode"=>$article->getId()!==null] );
    }

         /**
     * @route("/blog/{id}",name="blog_show")
     */
    public function show($id){
        $repo=$this->getDoctrine()->getRepository(Article::class);
        $article=$repo->find($id);
        return $this->render('blog/show.html.twig',["article"=>$article]);
    }

    
  
}
