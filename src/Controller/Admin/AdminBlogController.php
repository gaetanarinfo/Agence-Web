<?php
namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BlogType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class AdminBlogController extends AbstractController
{
    /**
     *
     * @var BlogRepository
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(BlogRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/blog", name="admin.blog.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $rents = $this->repository->findAll();
        return $this->render('admin/blog/index.html.twig', [
            'blogs' => $this->repository->paginateAllVisible2($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/admin/blog/create", name="admin.blog.new")
     */
    public function new(Request $request)
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                $this->em->persist($blog);
                $this->em->flush();
                $this->addFlash('success', 'Actualité crée avec succès');
                return $this->redirectToRoute('admin.blog.index');
        }

        return $this->render('admin/blog/new.html.twig', [
            'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/blog/{id}", name="admin.blog.edit", methods="GET|POST")
     * @param Blog $blog
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Blog $blog, Request $request)
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            if($form->isValid()){
                $blog->setUpdatedAt(new \DateTime('now'));
                $this->em->flush();
                $this->addFlash('success', 'Actualité modifié avec succès');
                return $this->redirectToRoute('admin.blog.index');
            }else{
                $this->addFlash('error', 'Une erreur est survenue');
                return $this->redirectToRoute('admin.blog.index');
            }
        }

        return $this->render('admin/blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/blog/{id}", name="admin.blog.delete", methods="DELETE")
     */
    public function delete(Blog $blog, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $blog->getId(), $request->get('_token')))
        {
            $this->em->remove($blog);
            $this->em->flush();
            $this->addFlash('success', 'Actualité supprimé avec succès');
            return $this->redirectToRoute('admin.blog.index');
        }else{
            $this->addFlash('error', 'Une erreur est survenue');
            return $this->redirectToRoute('admin.blog.index');
        }
    }
       
}

?>