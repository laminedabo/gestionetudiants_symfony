// alert('ok')

var url = "http://127.0.0.1:8000";
var limit = 5;
var offset = 0;

/*----------------------------------------------------
==============SUPRESSION ETUDIANT=====================
------------------------------------------------------*/ 
$(document).ready(function(){
    $('td button').click(function(){
        // alert($(this).attr('id'))
        let id = $(this).attr('id');
        if (confirm('Vous voulez supprimer cet(te) etudiant(e) ?')) {
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
                    $('.mesgRqet').addClass("p-1");
                    $('.mesgRqet').text(data.message);//ici data est un objet json
                    setTimeout( 
                        function() {
                          window.location.reload(true);
                        }, 2000);
                }
            })
        }
    })






/*-----------------------------------------------
====== Modifier les infos d'un Etudiant =========
-------------------------------------------------*/ 
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

    /*--------------------------------------------
            ======== Recherche Manuelle ========
    ----------------------------------------------*/ 
    $(document).ready(function(){
        $("#matr_search").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
})


    /*--------------------------------------------
            ======== Gestion Chambes ========
    ----------------------------------------------*/ 
$(document).ready(function(){
    //click bouton valider ajout chambre
    $('#addChbr').click(function(){
        // alert('ok');
        if ($('#typeChbre option:selected').val() === ''){
            $('#msgTypeErr').addClass("p-1");
            $('#msgTypeErr').text('Selectionnez le type de chambre');
            event.preventDefault();
        }
    })

    $('#typeChbre').change(function(){
        if ($('#typeChbre option:selected').val() != ''){
            $('#msgTypeErr').hide();
        }
    })

    //click bouton annuler ajout chambre
    $('#reset').click(function(){
        $('#msgTypeErr').hide();
        setTimeout( 
            function() {
            window.location.reload(true);
            }, 5);
    })
})

$(document).ready(function(){
    $('.navbar-nav .nav-item').click(function(){
        // alert('okkk');
        $(this).addClass(' active');
        $('.navbar-nav .nav-item').not(this).removeClass(' active');
    })
})