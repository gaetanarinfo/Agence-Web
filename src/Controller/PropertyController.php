<?php 

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\Common\Persistence\ObjectManager;
//use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Cocur\Slugify\Slugify;

class PropertyController extends AbstractController
{

    private $repository;

    /**
     * @var PropertyRepository
     * @var EntityManagerInterface
     */

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Responce
    */

    public function index(): Response
    {

        // $property = new Property();
        // $property->setTitle('Mon premier bien')
        //     ->setPrice(200000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setContent('Une petite description')
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Montpellier')
        //     ->setAdress('15 Boulevard Gambetta')
        //     ->setPostalCode('37500');
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($property);
        // $em->flush();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{slug}:{id}", name="property.show") requirements={"slug": [a-z0-9\-]""}
     * @param Propert $property
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug() 
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }

}

?>