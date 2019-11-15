<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class MultipleImagesController extends AbstractController
{
    /**
     * @Route("/multiple/images", name="multiple_images")
     */
    public function index()
    {
 $article = new Article();
    $form = $this->createForm(ArticleType::class,$article);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $attachments = $article->getImages();

        if ($attachments) {
            foreach($attachments as $attachment)
            {
                $file = $attachment->getImageFile();

                var_dump($attachment);
                $filename = md5(uniqid()) . '.' .$file->guessExtension();

                $file->move(
                        $this->getParameter('brochures_directory'), $filename
                );
                var_dump($filename);
                $attachment->setImageFile($file);
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

    
            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
}}
