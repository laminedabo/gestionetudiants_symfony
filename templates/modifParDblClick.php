<div class="mesgRqet d-inline ml-1 text-white bg-primary rounded"  style="width:auto"></div>

<table class="table tEtd table-striped">

        <thead>
            <tr class="">
                <th>Matricule</th>
                <th>Noms</th>
                <th>Prenoms</th>
                <th class="">Date naiss</th>
                <th class="">Email</th>
                <th class="">Telephone</th>
            </tr>
        </thead>
        <tbody id="tbody">
                        {% for etu in etudiants %}
            <tr>
                <td>{{ etu.matricule|e }}</td>
                <td id="t-nom-{{etu.id}}">{{ etu.nom|e }}</td>
                <td id="t-prenom-{{etu.id}}">{{ etu.prenom|e }}</td>
                <td id="d-dateNaiss-{{etu.id}}">{{ etu.DateNaiss|date("d/m/Y")|e }}</td>
                <td id="t-email-{{etu.id}}">{{ etu.email|e }}</td>
                <td id="t-telephone-{{etu.id}}">{{ etu.telephone|e }}</td>
                <td><button id="{{etu.id}}" style="background-color:;" class="fa fa-trash-o suppr" aria-hidden="true"></button></td>
            </tr>
            {% endfor %}
        </tbody>
    </table>




<script>
/*-----------------------------------------------
====== Modifier les infos d'un Etudiant =========
-------------------------------------------------*/ 
var url = "http://127.0.0.1:8000";

$(document).ready(function(){
        // 
    let coul;
    let clone;
    let type;
    // 
    $("#tbody")
    .on("click","tr",function(){
    //  alert($(this).html())
    coul=$("#tbody").css("background-color");
    $(this).css("background-color","#CF9B9B");
    $("#tbody tr").not(this).css("background-color",coul);
    })

    .on('dblclick',"td",function(){
        // alert($(this).attr('id'))
        // $(this).parents().css("background-color",coul);
        const id =$(this).attr("id");
        const tab = id.split("-");
        //console.log($(this).children().clone());
        type=tab[0];
        clone=type==="d"?$(this).children().clone():$(this).text();
    //    alert(clone)
        if((type==='t') || (type ==='d')){
            const input=getInput(tab,clone);
            $(this).html(input);
            $(this).children().focus();
        }
    })

    .on("focusout","td",function(e){
        
        const {id,value} = e.target;
        const tab=id.split("-");
        if(type==='t' || type === 'd') {
            if(value.trim() != "" && value.trim() != clone){
                if (tab[0]==='email' && !isEmail(value)) {
                    $('.mesgRqet').addClass("p-1 bg-danger");
                    $('.mesgRqet').text('Email non valide');
                    return false;
                }
                $(this).html(value); 
                const data={
                    "update":"Etudiant",
                    "champ":tab[0],
                    "id":tab[1],
                    "val":value
                }
                $.ajax({
                method:"POST",
                url: url+"/etudiant/update",
                data:data
                })
                .done(data =>{
                    $('.mesgRqet').addClass("p-1");
                    $('.mesgRqet').text(data.msg);
                    console.log(data.val);
                })
            }
            else{
                $('.mesgRqet').addClass("p-1");
                $('.mesgRqet').text('Modification annulée');
                $(this).html(clone);
            } 
        }
        setTimeout( 
            function() {
            window.location.reload(true);
            }, 2000);
        
    })

    /*--------------------------------------------
        =========== Generateur d'inputs ===========
    ----------------------------------------------*/
    function getInput(tab,txt){
        const tp={
            "t":"text",
            "d":"date"
        };
        type=tab[0];
        const v= type=="d"?'':` value="${txt}"`;
        const input = `<input type ="${tp[type]}" id="${tab[1]}-${tab[2]}" ${v} />`;
        return input;
    }

    /*--------------------------------------------
        =========== Test de l'email =============
    ----------------------------------------------*/
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
})
</script>


use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\JsonResponse;

    class EtudiantController extends AbstractController{
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
                ]);
            }
            return new Response('Erreur!', 400);
        }
    }

    