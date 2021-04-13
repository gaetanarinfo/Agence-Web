<?php 

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\Blog;
use App\Form\BlogSearchType;
use App\Entity\BlogSearch;
use App\Entity\CommentBlog;
use App\Entity\User;
use App\Form\CommentType;
use App\Repository\BlogRepository;
use App\Repository\CommentBlogRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    private $repository;

    /**
     * @var BlogRepository
     * @var EntityManagerInterface
     */

    public function __construct(BlogRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/blog", name="blog.index")
     * @return Responce
    */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $search = new BlogSearch();
        $form = $this->createForm(BlogSearchType::class, $search);
        $form->handleRequest($request);
        return $this->render('blog/index.html.twig', [
            'current_menu' => 'blog',
            'blogs' => $this->repository->paginateAllVisible($search, $request->query->getInt('page', 1)),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog.show") requirements={"id": [0-9\-]""}
     * @param Blog $blog
     * @return Response
     */
    public function show(Blog $blog, Request $request, BlogRepository $repositoryBlog, CommentBlogRepository $repositoryComment): Response
    {
        $blogRecent = $repositoryBlog->findLatest();
        $countComment = $repositoryComment->findCount($blog->getId());
        $comments = $repositoryComment->findLatest($blog->getId());

        $comment = new CommentBlog();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAuthor($blog->getAuthor());
            $comment->setBlogId($blog->getId());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success', 'Votre commentaire à été poster');
            return $this->redirectToRoute('home');

    
        }

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
            'blogRecent' => $blogRecent,
            'comment' => $comments,
            'countComment' => $countComment,
            'form' => $form->createView()
        ]);
    }
}