<?php

namespace Stagia\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stagia\AppBundle\Entity\Memoire;
use Stagia\AppBundle\Form\MemoireType;
use Symfony\Component\HttpFoundation\Response;

class MemoireController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $memoires = $em->getRepository('StagiaAppBundle:Memoire')->findAll();

        return $this->render('StagiaAppBundle:Memoire:index.html.twig', array(
            'memoires' => $memoires,
        ));
    }
    public function createAction(Request $request)
    {
        $memoire = new Memoire();
        $form = $this->createCreateForm($memoire);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $memoire->setUtilisateurCreateur($this->getUser());
            $memoire->setDateCreation(new \DateTime());
            $em->persist($memoire);
            $em->flush();
            $this->addFlash('success', 'Mémoire créé avec succès !');
            return $this->redirect($this->generateUrl('memoire_show', array('id' => $memoire->getId())));
        }

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'memoire' => $memoire,
            'form'   => $form->createView(),
        ));
    }

    private function createCreateForm(Memoire $memoire)
    {
        $form = $this->createForm(new MemoireType(), $memoire);

        return $form;
    }

    public function newAction()
    {
        $memoire = new Memoire();
        $form   = $this->createCreateForm($memoire);

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'memoire' => $memoire,
            'form'   => $form->createView(),
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Mémoire introuvable.');
        }

        return $this->render('StagiaAppBundle:Memoire:show.html.twig', array(
            'memoire'      => $memoire
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Memoire introuvable.');
        }

        $editForm = $this->createEditForm($memoire);

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'memoire'      => $memoire,
            'edit_form'   => $editForm->createView(),
        ));
    }

    private function createEditForm(Memoire $memoire)
    {
        $form = $this->createForm(new MemoireType(), $memoire);
        return $form;
    }
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Mémoire introuvable.');
        }
        $editForm = $this->createEditForm($memoire);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $fileUploaded = null !== $editForm['file']->getData();
            if($fileUploaded) {
                $memoire->setFile($editForm['file']->getData());
                $memoire->preUpload();
            }
            $em->flush();
            if($fileUploaded){
                $memoire->upload();
            }
            $this->addFlash('success', 'Mémoire modifié avec succès');

            return $this->redirect($this->generateUrl('memoire_show', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'memoire'      => $memoire,
            'edit_form'   => $editForm->createView()
        ));
    }
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Mémoire introuvable');
        }

        $em->remove($memoire);
        $em->flush();
        $this->addFlash('success', 'Mémoire supprimé avec succès');

        return $this->redirect($this->generateUrl('memoire'));
    }
    
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recherche = $request->get('recherche');
        $memoires = null;
        if($recherche)
        {
           $qb = $em->createQueryBuilder();

           $qb->select('m')
              ->from('StagiaAppBundle:Memoire', 'm')
              ->where("m.nom LIKE :recherche ")
              ->orderBy('m.nom', 'ASC')
              ->setParameter('recherche', '%'.$recherche.'%');

           $query = $qb->getQuery();              
           $memoires = $query->getResult();
        }
        else
        {
            $memoires = $em->getRepository('StagiaAppBundle:Memoire')->findAll();
        }
        if(!$request->isXmlHttpRequest()) {
            return $this->render('StagiaAppBundle:Memoire:index.html.twig', array(
                'memoires' => $memoires,
                'texteRecherche' => $recherche
            ));
        }
        return $this->render('StagiaAppBundle:Memoire:listeMemoire.html.twig', array('memoires' => $memoires)); 
    }
    
    public function downloadAction($id) {
        $em = $this->getDoctrine()->getManager();
        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);
         
        $urlFile = $memoire->getAbsolutePath();
        $content = file_get_contents($urlFile);
         
        $response = new Response();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition','attachment; filename="' . $memoire->getFilename() . '"');
         
        $response->setContent($content);
        return $response;
    }
}
