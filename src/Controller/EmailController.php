<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ReservationRepository;
use App\Entity\Reservation;
class EmailController extends AbstractController
{
    /**
     * @Route("/email/{id}", name="email",methods={"GET","POST"})
     */
     public function Email(\Swift_Mailer $mailer,$id,ArticleRepository $articleRepository ,Request $request,ReservationRepository $reservationRepository )
    {
    	dump(  $request->getClientIp());
$myIp =$_SERVER['REMOTE_ADDR'];
    $message = (new \Swift_Message('reservation'))

        ->setFrom('mobisoftplus@gmail.com')
        ->setTo($request->request->get('email'))
       ->setBody(  
    $this->renderView( 'ReservationPage/reservation.html.twig', [
  'nom' => $request->request->get('nom'),
'pren' => $request->request->get('pren'),
'email' => $request->request->get('email'),
'tel' => $request->request->get('tel'),
'id' => $id,
'myIp' => $myIp]), 'text/html');
        $message2 = (new \Swift_Message('reservation'))

        ->setFrom('mobisoftplus@gmail.com')
        ->setTo($request->request->get('email'))
       ->setBody(  'Uzita travel vous informer que votre réservation a été avec succès ');
    $mailer->send($message);
    $mailer->send($message2);
$reservation  = new Reservation () ;
$article= $articleRepository->find($id);
$reservation ->setEmail($request->request->get('email'));
$reservation ->setTel($request->request->get('tel'));
$reservation ->setNom($request->request->get('nom'));
$reservation ->setPrenom($request->request->get('pren'));
$reservation ->setArticle($article);
            $entityManager = $this->getDoctrine()->getManager();

     $entityManager->persist($reservation);
            $entityManager->flush();

                return $this->redirectToRoute('detailArticle',['id' => $id]);




}

/**
     * @Route("/emailvOL/{id}", name="emailvol")
     */
     public function emailvOL(\Swift_Mailer $mailer,$id,ArticleRepository $articleRepository ,Request $request,ReservationRepository $reservationRepository )
    {
        $myIp =$_SERVER['REMOTE_ADDR'];

    $message = (new \Swift_Message('reservation'))

        ->setFrom('mobisoftplus@gmail.com')
        ->setTo($request->request->get('email'))
       ->setBody(  
    $this->renderView( 'ReservationPage/reservationVol.html.twig', [
  'nom' => $request->request->get('nom'),
'pren' => $request->request->get('pren'),
'email' => $request->request->get('email'),
'tel' => $request->request->get('tel'),
'adulte' => $request->request->get('adulte'),
'jeune' => $request->request->get('jeune'),
'class' => $request->request->get('class'),
'from' => $request->request->get('from'),
'to' => $request->request->get('to'),


'id' => $id,
'myIp' => $myIp]), 'text/html');
        $message2 = (new \Swift_Message('reservation'))

        ->setFrom('mobisoftplus@gmail.com')
        ->setTo($request->request->get('email'))
       ->setBody(  'Uzita travel vous informer que votre réservation a été avec succès ');
        $mailer->send($message);
         $mailer->send($message2);
$reservation  = new Reservation () ;
$article= $articleRepository->find($id);
$reservation ->setEmail($request->request->get('email'));
$reservation ->setTel($request->request->get('tel'));
$reservation ->setNom($request->request->get('nom'));
$reservation ->setPrenom($request->request->get('pren'));
$reservation ->setArticle($article);
            $entityManager = $this->getDoctrine()->getManager();

     $entityManager->persist($reservation);
            $entityManager->flush();

                return $this->redirectToRoute('vols');




}
}
