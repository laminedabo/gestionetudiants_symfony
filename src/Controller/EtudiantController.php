<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\EtudiantBoursier;
use App\Entity\EtudiantNonBoursier;
use App\Entity\EtudiantLoge;
use App\Entity\Chambre;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use App\Repository\EtudiantBoursierRepository;
use App\Repository\EtudiantNonBoursierRepository;
use App\Repository\EtudiantLogeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Serializer\SerializerInterface;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }
    /**
     * @Route("etudiant/listeEtudiant", name="listeEtudiant")
     */
    public function liste()
    {
        $etu = $this -> getDoctrine() -> getRepository(Etudiant::class)->findAll();
        // dd($etu);
        return $this->render('etudiant/listeEtudiant.html.twig', [
            'controller_name' => 'EtudiantController',
            'msg' => 'Liste de tous les etudiants',
            'etudiants' => $etu,
        ]);
    }
    
    /**
     * @Route("etudiant/boursier", name="boursier")
     */
    public function listeBoursier()
    {
        $etu = $this -> getDoctrine() -> getRepository(EtudiantBoursier::class)->findAll();
        // dd($etu);
        return $this->render('etudiant/boursier.html.twig', [
            'controller_name' => 'EtudiantController',
            'msg' => 'Liste des etudiants boursiers',
            'etudiants' => $etu,
        ]);
    }

    /**
     * @Route("etudiant/loge", name="loge")
     */
    public function listeLoge()
    {
        $etu = $this -> getDoctrine() -> getRepository(EtudiantLoge::class)->findAll();
        // dd($etu);
        return $this->render('etudiant/loge.html.twig', [
            'controller_name' => 'EtudiantController',
            'msg' => 'Liste des etudiants logés',
            'etudiants' => $etu,
        ]);
    }

    /**
     * @Route("etudiant/nonBoursier", name="nonBoursier")
     */
    public function listeNonBoursier()
    {
        $etu = $this -> getDoctrine() -> getRepository(EtudiantNonBoursier::class)->findAll();
        // dd($etu);
        return $this->render('etudiant/nonBoursier.html.twig', [
            'controller_name' => 'EtudiantController',
            'msg' => 'Liste des etudiants non boursiers',
            'etudiants' => $etu,
        ]);
    }

  

    /**
     * @Route("etudiant/update", name="etudiant_update", methods={"GET","POST"})
     */
    public function update(Request $request)
    {
        if ($request->isXMLHttpRequest()) {         
            $id = $request->request->get('id');
            $ch = $champ = $request->request->get('champ');
            $champ = ucfirst($champ);//champ = Nom
            $champ = "Set".$champ;//SetNom
            $val = $request->request->get('val');
            if (strtotime($val)){  //si la valeur est une date
                $val = new \DateTime($val);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $etu = $entityManager->getRepository(Etudiant::class)->find($id);
            $etu -> $champ($val); //$etudiant -> SetNom('Aliou');
            $entityManager->flush();
            // dd($etu);
            return new JsonResponse([
                'msg' => 'Modification éffectuée.',
                'champ' => $ch,//champ modifié
                'val' => $val,
            ]);
        }
        return new Response('Erreur!', 400);
    }


    
    /**
     * @Route("etudiant/liste", name="liste_ajax")
     */
    public function liste_ajax(Request $request)
    {
        return $this->render('etudiant/listWithAjax.html.twig', [
            'controller_name' => 'EtudiantController',
            'msg' => 'Liste de tous les etudiants',
        ]);
    }


    /**
     * @Route("etudiant/listeAjax", name="listeAjax", methods={"GET","POST"})
     */
    public function ajax_list(Request $request, SerializerInterface $serialiser)
    {
        if ($request->isXMLHttpRequest()) {         
            $Etudiant=new Etudiant();
            $Etudiant = $this -> getDoctrine() -> getRepository(Etudiant::class)->findAll();
            // $p = $Etudiant[0];
            $etd = [];
            // $etu = $serialiser -> serialize($p, 'json');
            $i = 0;
            foreach ($Etudiant as $key => $value) {
                $etd[$i]['id'] = $value -> getId();
                $etd[$i]['matricule'] = $value -> getMatricule();
                $etd[$i]['nom'] = $value -> getNom();
                $etd[$i]['prenom'] = $value -> getPrenom();
                $etd[$i]['date_naiss'] = $value -> getDateNaiss();
                $etd[$i]['email'] = $value -> getEmail();
                $etd[$i]['telephone'] = $value -> getTelephone();
                $i++;
           }
            return new JsonResponse([
                'etd'=> $etd,
                // 'etu' => $etu,
            ]);
        }
        return new Response('Erreur! ce n est pas une requete Ajax', 400);
    }


      
    /**
     * @Route("etudiant/{id<[0-9]+>}/delete", name="delete_etudiant")
     */
    public function delete_etudiant(EntityManagerInterface $em, Request $request, $id)
    {
        if ($request->isXMLHttpRequest()) {         
            $etu = $this -> getDoctrine() -> getRepository(Etudiant::class)->find($id);
            $em->remove($etu);
            $em->flush();
            return new JsonResponse(array('message' => 'Suppression reussie'));
        }
        return new Response('Erreur! ce n est une requete Ajax', 400);
    }

      
    /**
     * @Route("etudiant/search", name="recherche")
     */
    public function search(EtudiantRepository $er, SerializerInterface $serialiser, Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $query = $er -> createQueryBuilder('etudiant');
            $data = [];
            $val = $request -> request -> get('matricule');
            $val = (string)$val; 
            $query -> andWhere('etudiant.matricule like :val');
            $data = $query -> setParameter('val', '%'.$val.'%')
                            -> getQuery()
                            -> getResult();
            // dd($data);
            $etd = [];
            $i = 0;
            foreach ($data as $key => $value) {
                $etd[$i]['id'] = $value -> getId();
                $etd[$i]['matricule'] = $value -> getMatricule();
                $etd[$i]['nom'] = $value -> getNom();
                $etd[$i]['prenom'] = $value -> getPrenom();
                $etd[$i]['date_naiss'] = $value -> getDateNaiss();
                $etd[$i]['email'] = $value -> getEmail();
                $etd[$i]['telephone'] = $value -> getTelephone();
                $i++;
           }
            return new JsonResponse([
                'etd'=> $etd,
            ]);
        }
        return new Response('Erreur! ce n est une requete Ajax', 400);
    }

    /**
    *@Route("etudiant/inscription",name = "inscription")
    */
    public function inscription(Request $request):Response{

        $date = new \DateTime('now -19 year');

        $etd  = new etudiant();
        $etd -> setMatricule('2016 LO KH 0010');
        $etd -> setNom('Khalil');
        $etd -> setPrenom('Lo');
        $etd -> setDateNaiss($date);
        $etd -> setEmail('khalil@gmail.com');
        $etd -> setTelephone(776093303);

        // $etd_boursier = new EtudiantBoursier();
        // $etd_boursier -> setMotantBourse(4000);
        // $etd_boursier -> setEtudiant($etd);

        $etd_non_boursier = new EtudiantNonBoursier(); // non boursier = Non logé
        $etd_non_boursier -> setAdresse('Tamba');
        $etd_non_boursier -> setEtudiant($etd);

        
        // $ch = $this->getDoctrine()->getRepository(Chambre::class)->find(4);
        // $etd_loge = new EtudiantLoge();
        // $etd_loge -> setChambre($ch);
        // $etd_loge -> setEtudiant($etd);

        // $etd -> setBoursier($etd_boursier);
        $etd -> setNonLoge($etd_non_boursier);
        // $etd -> setLoge($etd_loge);

    //    $entityManager = $this->getDoctrine()->getManager();
        // $entityManager->persist($etd);
        // $entityManager->persist($etd_boursier);
        // $entityManager->persist($etd_non_boursier);
        // $entityManager->persist($etd_loge);
        // $entityManager->flush();
        // $form = $this->createFormBuilder()
        //     ->add('Prenom', TextType::class)
        //     ->add('Nom', TextType::class)
        //     ->add('Date', DateType::class)
        //     ->getForm();

        
        return $this -> render('etudiant/inscription.html.twig',[
            'etudiant' => $etd,
            'typeEtd' => $etd_non_boursier,
            // 'form' => $form->createView(),
        ]);
    }
    
}
