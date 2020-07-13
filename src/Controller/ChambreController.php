<?php

namespace App\Controller;


use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    /**
     * @Route("/chambre", name="chambre")
     */
    public function index()
    {
        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }

      /**
     * @Route("/chambre/create", name="chambre_create")
     */
    public function create(Request $request):Response
    {
        $chambre = new Chambre();
        $chambre -> setNumChambre(0);//pas necessaire mais obligatoire vue que c'est deja declare
        $form_chambre = $this->createForm(ChambreType::class,$chambre);
        $form_chambre->handleRequest($request);
        if($form_chambre->isSubmitted() && $form_chambre->isValid()){
            $chambre -> setType($request -> request -> get('typeChbre'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();
            // dd($chambre);
            return $this->redirectToRoute('chambre_create');
        }
        return $this->render('/chambre/ajout.html.twig', [
             'form_chambre'=> $form_chambre->createView(),
             'chambre' => $chambre,
             'msg' => 'Enregistrement chambre',
        ]);
    }
}
