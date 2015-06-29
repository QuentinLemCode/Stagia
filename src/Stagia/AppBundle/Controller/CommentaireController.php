<?php

namespace Stagia\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stagia\AppBundle\Entity\Commentaire;
use Stagia\AppBundle\Form\CommentaireType;

/**
 * Commentaire controller.
 *
 */
class CommentaireController extends Controller
{
    public function postAction($sujet_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sujet = $this->getSujet($sujet_id);
        
        $commentaire = new Commentaire();        
        $commentaireform = $form = $this->createForm(new CommentaireType(), $commentaire, array(
            'action' => $this->generateUrl('commentaire_post', array(
                'sujet_id' => $sujet_id
            )),
            'method' => 'POST',
        ));
        $commentaireform->handleRequest($request);
        
        if($commentaireform->isValid())
        {
            $commentaire->setSujet($sujet);
            $commentaire->setDateCreation(new \DateTime());
            $commentaire->setUtilisateurCreateur($this->getUser());
            $sujet->addCommentaire($commentaire);
            $em->persist($commentaire);
            $em->persist($sujet);
            $em->flush();
        }
        
        
        return $this->redirectToRoute('sujet_show', array('id' => $sujet->getId()));
        
    }
    
    private function getSujet($id)
    {
        $em = $this->getDoctrine()->getManager();

        $sujet = $em->getRepository('StagiaAppBundle:Sujet')->find($id);
        
        if(!$sujet)
        {
            throw $this->createNotFoundException('Sujet '.$id.' introuvable !');
        }
        
        return $sujet;
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $commentaire = $em->getRepository('StagiaAppBundle:Commentaire')->find($id);

        if (!$commentaire) {
            throw $this->createNotFoundException('Commentaire introuvable.');
        }

        $editForm = $this->createEditForm($commentaire);

        return $this->render('StagiaAppBundle:Commentaire:edit.html.twig', array(
            'commentaire'      => $commentaire,
            'edit_form'   => $editForm->createView(),
        ));
    }

    private function createEditForm(Commentaire $commentaire)
    {
        $form = $this->createForm(new CommentaireType(), $commentaire);
        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $commentaire = $em->getRepository('StagiaAppBundle:Commentaire')->find($id);
        $sujet_id = $commentaire->getSujet()->getId();

        if (!$commentaire) {
            throw $this->createNotFoundException('Commentaire introuvable');
        }

        $editForm = $this->createEditForm($commentaire);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Le commentaire a bien été modifié !');
            return $this->redirect($this->generateUrl('sujet_show', array('id' => $sujet_id)));
        }

        return $this->render('StagiaAppBundle:Commentaire:edit.html.twig', array(
            'commentaire'      => $commentaire,
            'edit_form'   => $editForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('StagiaAppBundle:Commentaire')->find($id);

        if (!$commentaire) {
            throw $this->createNotFoundException('Commentaire introuvable.');
        }
        $sujet_id = $commentaire->getSujet()->getId();

        $em->remove($commentaire);
        $em->flush();
        $this->addFlash('success', 'Le commentaire a bien été supprimé !');
        return $this->redirect($this->generateUrl('sujet_show', array('id' => $sujet_id)));
    }
}
