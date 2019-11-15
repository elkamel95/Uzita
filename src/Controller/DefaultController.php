<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HotelRepository;
use App\Repository\VolRepository;
use App\Service\Rebriqueimage;

use App\Repository\PromosRepository;
use App\Repository\VoyageRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use App\Repository\OmraRepository;

class DefaultController extends AbstractController
{
    
    public function index(HotelRepository $hotelRepository,ArticleRepository $articleRepository ,Request $request)
    {

if($this->getUser()==null){

 return $this->render('default/index.html.twig', [
            'hotET' => $hotelRepository->findIDPayetrange(0),
            'hotTN' => $hotelRepository->findIDPaye(0),
            'promo'=>$articleRepository->findByPromo(1,5), 
            'TopDist' =>$articleRepository->findByTopDistination(1),
            'TopHotel'=> $hotelRepository->findByTopHotel(1),
            'article'=> $articleRepository->findAllforSlider(),

        ]);


}else{

return $this->redirectToRoute('adminprofile',['user'=>$this->getUser()]);
}
       

    }
public function admin(){


return $this->redirectToRoute('fos_user_security_login');



        }  



          public function indexadmin()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    public function addPromo()
    {
        $Promos = new Promos;
        $form = $this->get('form.factory')->create(PromosType::class, $Promos);

        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);
           // $article->getImage()->upload();

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($Promos);
              $em->flush();
      
              $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
      
              // On redirige vers la page de visualisation de l'annonce nouvellement créée
              return $this->redirectToRoute('administrateurGalerire');
            }
          }
      
        return $this->render('@Safari/admin/Client/AddPromos.html.twig', array(
            'form' => $form->createView(),
          ));
        
    }
    public function hotels(HotelRepository $hotelRepository,Request $request ,ArticleRepository $articleRepository )
    {

        $from=new \DateTime($request->query->get('from'));

$to=new \DateTime($request->query->get('to'));
        if($request->query->get('serch')!=null){
            
        if($request->query->get('from')!=null){

  if($hotelRepository->findPayeAndDate($request->query->get('serch'),$request->query->get('categorie_rech'),$from,$to)!=null){

return $this->render('default/hotels.html.twig', ['hot' => $hotelRepository->findPayeAndDate($request->query->get('serch'),$request->query->get('categorie_rech'),$from,$to),'article'=> $articleRepository->findAllforSlider(),
        ]); 

  }else{

return $this->render('default/hotels.html.twig', ['hot' => $hotelRepository->findVillAndDate($request->query->get('serch'),$request->query->get('categorie_rech'),$from,$to),'article'=> $articleRepository->findAllforSlider(),
        ]);

  }
      

     } else{
if($hotelRepository->findPaye($request->query->get('serch'),$request->query->get('categorie_rech')) !=null)
{  

return $this->render('default/hotels.html.twig', [
                    'hot' => $hotelRepository->findPaye( 
                        $request->query->get('serch'),
                        $request->query->get('categorie_rech')
                    ),'article'=> $articleRepository->findAllforSlider(),
        ]);

}else{
var_dump($request->query->get('serch'));
return $this->render('default/hotels.html.twig', [
                    'hot' => $hotelRepository->findVille( $request->query->get('serch'),
                        $request->query->get('categorie_rech')

                    ),            'article'=> $articleRepository->findAllforSlider(),

        ]);

}
      

        }
                           


}else{
   return $this->render('default/hotels.html.twig', [
                    'hot' => $hotelRepository->findAllHot(),'article'=> $articleRepository->findAllforSlider(),
        ]); 


        }




    }
    public function billeterie()
    {
        return $this->render('default/billeterie.html.twig', [
            'controller_name' => 'DefaultController',
        ]);    
    }
    public function vols(VolRepository $VolRepository,ArticleRepository $articleRepository)
    {
        return $this->render('default/vols.html.twig', [
            'vols' => $VolRepository->findAll(),            
            'article'=> $articleRepository->findAllforSlider(),

        ]);
    }
    public function DetailHotel(HotelRepository $hotelRepository)
    {

        return $this->render('default/DetailHotel.html.twig', [
                    'hot' => $hotelRepository->findPaye('tunisie'),
        ]);
    }


 
        public function Voyage(Request $request, VoyageRepository $VoyageRepository, ArticleRepository $ArticleRepository)
    {
if(strtoupper ($request->query->get('id')) == 'TUNISIE')
       $voyage = $VoyageRepository->findBySejour($request->query->get('id'));
   else
           $voyage = $VoyageRepository->findPayET();


$r=new Rebriqueimage();
$stackF=$r->setObject($voyage);



        return $this->render('default/voyage.html.twig', [
            'id' => $request->query->get('id'),
            'stackF'=>$stackF,
            'pays'=>strtoupper ($request->query->get('id')),
             'article'=> $ArticleRepository->findAllforSlider(),
        ]);
    }
public function transfert(Request $request, VoyageRepository $VoyageRepository, ArticleRepository $ArticleRepository)
    {
       $voyage = $VoyageRepository->findAlltransfert();
   $r=new Rebriqueimage();
    $stackF=$r->setObject($voyage);




        return $this->render('default/transfert.html.twig', [
            'stackF'=>$stackF,
        ]);
    }
    public function circuits(Request $request, VoyageRepository $VoyageRepository, ArticleRepository $ArticleRepository)
    {
       $voyage = $VoyageRepository->findAllcircuits();
   
       
          $r=new Rebriqueimage();
    $stackF=$r->setObject($voyage);


        return $this->render('default/circuits.html.twig', [
            'stackF'=>$stackF,
        ]);
    }
 
        public function VoyageSearch(Request $request, VoyageRepository $VoyageRepository, ArticleRepository $ArticleRepository)
    {
        $from=new \DateTime($request->query->get('from'));

$to=new \DateTime($request->query->get('to'));
$destination=$request->query->get('destination');
$paye=$request->query->get('paye');


if($request->query->get('from') != null){
     $voyage=$VoyageRepository->findArticleByDatDepart($from,$to,$paye,$destination);}
 else{
    var_dump($destination);
    $voyage=$VoyageRepository-> findPaye($paye,$destination);


 }

       //$voyage = $VoyageRepository->findBySejour($request->query->get('id'));
         $r=new Rebriqueimage();
    $stackF=$r->setObject($voyage);


        return $this->render('default/voyage.html.twig', [
            'stackF'=>$stackF,
            'id'=>$paye=strtoupper ($request->query->get('paye')),
                        'article'=> $ArticleRepository->findAllforSlider(),


        ]);
    
       }
    public function detailArticle(ArticleRepository $articleRepository,Request $request)
    {

        return $this->render('default/detailArticle.html.twig', [
            'hot' => $articleRepository->find($request->query->get('id')),
        ]);    
    }
    public function indexadministration()
    {
return $this->redirectToRoute('fos_user_security_login');

        
      
    }
  public function contact()
    {


        return $this->render('default/contact.html.twig');  
        
      
    }

    public function promo(PromosRepository $promosRepository,Request $request)
    {


        return $this->render('default/promo.html.twig', [
                'promos' => $promosRepository->findAllPromo(1),
        ]);    
    }

    public function omra(OmraRepository $OmraRepository,Request $request)
    {
       


        return $this->render('default/Omra.html.twig',[            'omras' => $OmraRepository->findAll(),
]);    
    }
public function volsearch( VolRepository $VolRepository,Request $request,ArticleRepository $articleRepository){
 $TypeVol=$request->query->get('TypeVol');


 $depart=$request->query->get('depart');
  
 $dest=$request->query->get('dest');

$vol=$VolRepository->findByVolAlleRetoure($TypeVol, $depart,$dest);








return $this->render('default/vols.html.twig', [
            'vols' => $vol,            'article'=> $articleRepository->findAllforSlider(),

        ]);

}
public function uzitaTravel( ){


return $this->render('default/uzitaTavel.html.twig');

}
  


}
