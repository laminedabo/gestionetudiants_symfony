

var url = "http://127.0.0.1:8000"; // Partie intacte/fixe de l'URL

    /*================================================================
	------------------PARTIE LISTE DES ETUDIANTS------------------------
	=================================================================*/
    // var limit = 5;
    // var offset = 0;
 
// alert('ok');
    /*-----------------------------------------------------
	====================fonction liste=====================
    -------------------------------------------------------*/

	function listeEtudiant(){
		$.ajax({
			method: "POST",
            url: url+"/etudiant/listeAjax",
			data: {}, 
			dataType: "JSON",
		})
		.done(data =>{
            addLine(data.etd);
            // alert(data[0]);
            console.log(data.etd);
            // console.log(data.etu);

        })
    }
    
    listeEtudiant();//appel de la fonction pour lister

	/*---------------------------------
	----Ajouter de nouvelles lignes-----
	-----------------------------------*/ 
	function addLine(values){
        // console.log(values);
        $("#tAjax").empty();
        let line;
		for (let i = 0; i < values.length; i++){
            let date = values[i].date_naiss.date.split(" ")[0].split('-').reverse().join("/");
			line = `
                <tr class="text-center" id = ligne-${values[i].id}>
                    <td  id = matricule-${values[i].id}>${values[i].matricule}</td>
                    <td  id = t-nom-${values[i].id}>${values[i].nom}</td>
                    <td  id = t-prenom-${values[i].id}>${values[i].prenom}</td>
					<td  id = d-date_naiss-${values[i].id}>${date}</td>
					<td  id = t-email-${values[i].id}>${values[i].email}</td>
                    <td  id = t-tel-${values[i].id}>${values[i].telephone}</td>
                    <td><button id = ${values[i].id} type="button" class="delete btn btn-danger">Supprimer</button></td>
                </tr>`;
            $("#tAjax").append(line);
		}
    }



    /*---------------------------------------------
    =========Click sur le bouton supprimer ========
    ----------------------------------------------*/
    $(document).on("click",".delete", function () {

        // alert($(this).attr('id'))
        let id = $(this).attr('id');
        if (id) {
            if (confirm('Voulez vous supprimer cet etudiant ?')) {
                const data={
                    "id":id
                }
                $.ajax({
                method:"POST",
                url: url+"/etudiant/"+id+"/delete",
                data:data
                })
                .done(data =>{
                    if (data) {
                        $('#ligne-'+id).fadeOut( "slow" );//chacher l'element
                        $('.mesgRqet').addClass("p-1");
                        $('.mesgRqet').text(data.message);//ici data est un objet json
                        setTimeout( 
                            function() {
                              window.location.reload(true); //recharger la page 3s apres
                            }, 3000);
                    }
                })
            }
        }
    })

    /*----------------------------------------------------
    ========= Recherche par matricule dans la bdd ========
    -----------------------------------------------------*/
    $(document).ready(function(){
        $('#matri_search').on('keyup change', function(){
            // alert($(this).val())
            $('#ajax-load').addClass("d-block");
            let val = $(this).val();
            $data={
                "matricule":val
            }
            $.ajax({
                url:url+"/etudiant/search",
                data: $data,
                method:"POST",
                dataType:"JSON",
                success:function(data){
                    // alert(data.etd);
                    addLine(data.etd);
                    $('#ajax-load').removeClass("d-block");
                }
            })

        })
    })
