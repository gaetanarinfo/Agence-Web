<?php 

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{

    private $twig;
    private $repository;

    /**
     * @var PropertyRepository
     * @var Environement
     */

    public function __construct(PropertyRepository $repository, $twig)
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

        $property = $this->repository->findAllVisible();
        $property[0]->setSold(true);
        dump($property);

        return new Response($this->twig->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]));
    }

}

?>