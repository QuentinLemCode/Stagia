<?php

namespace Stagia\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stagia\AppBundle\Entity\Sujet;
use Stagia\AppBundle\Form\SujetType;
use Stagia\AppBundle\Entity\Commentaire;
use Stagia\AppBundle\Form\CommentaireType;

/**
 * Sujet controller.
 *
 */
class SujetController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sujets = $em->getRepository('StagiaAppBundle:Sujet')->findAll();

        return $this->render('StagiaAppBundle:Sujet:index.html.twig', array(
            'sujets' => $sujets,
        ));
    }
    public function createAction(Request $request)
    {
        $sujet = new Sujet();
        $form = $this->createCreateForm($sujet);
        $form->handleRequest($request);

        if(!$this->getUser())
        {
            throw $this->createAccessDeniedException("Vous devez être connecté pour poster un sujet");
        }
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $sujet->setUtilisateurCreateur($this->getUser());
            $sujet->setDateCreation(new \DateTime);
            $em->persist($sujet);
            $em->flush();
            $this->addFlash('success', 'Sujet de mémoire enregistré !');
            return $this->redirect($this->generateUrl('sujet_show', array('id' => $sujet->getId())));
        }

        return $this->render('StagiaAppBundle:Sujet:new.html.twig', array(
            'sujet' => $sujet,
            'form'   => $form->createView(),
        ));
    }

    private function createCreateForm(Sujet $sujet)
    {
        $form = $this->createForm(new SujetType(), $sujet, array(
            'action' => $this->generateUrl('sujet_create'),
            'method' => 'POST',
        ));
        return $form;
    }

    
    public function newAction()
    {
        $sujet = new Sujet();
        $form   = $this->createCreateForm($sujet);

        return $this->render('StagiaAppBundle:Sujet:new.html.twig', array(
            'sujet' => $sujet,
            'form'   => $form->createView(),
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $sujet = $em->getRepository('StagiaAppBundle:Sujet')->find($id);
        
        $commentaires = $sujet->getCommentaires();
        
        $commentaire = new Commentaire();
        
        $commentaireform = $form = $this->createForm(new CommentaireType(), $commentaire, array(
            'action' => $this->generateUrl('commentaire_post', array(
                'sujet_id' => $sujet->getId()
            )),
            'method' => 'POST',
        ));

        if (!$sujet) {
            throw $this->createNotFoundException('Unable to find Sujet sujet.');
        }
        return $this->render('StagiaAppBundle:Sujet:show.html.twig', array(
            'commentaireform' => $commentaireform->createView(),
            'commentaires' => $commentaires,
            'sujet'      => $sujet
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $sujet = $em->getRepository('StagiaAppBundle:Sujet')->find($id);

        if (!$sujet) {
            throw $this->createNotFoundException('Unable to find Sujet sujet.');
        }

        $editForm = $this->createEditForm($sujet);

        return $this->render('StagiaAppBundle:Sujet:edit.html.twig', array(
            'sujet'      => $sujet,
            'edit_form'   => $editForm->createView()
        ));
    }

    private function createEditForm(Sujet $sujet)
    {
        $form = $this->createForm(new SujetType(), $sujet);
        return $form;
    }
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $sujet = $em->getRepository('StagiaAppBundle:Sujet')->find($id);
        $name = $sujet->getNom();
        
        if (!$sujet) {
            throw $this->createNotFoundException('Sujet introuvable');
        }
        $editForm = $this->createEditForm($sujet);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Le sujet de mémoire "'.$name.'" a bien été modifié !');
            return $this->redirect($this->generateUrl('sujet', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Sujet:edit.html.twig', array(
            'sujet'      => $sujet,
            'edit_form'   => $editForm->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('StagiaAppBundle:Sujet')->find($id);
        $name = $sujet->getNom();

        if (!$sujet) {
            throw $this->createNotFoundException('Sujet introuvable');
        }
        $em->remove($sujet);
        $em->flush();
        $this->addFlash('success', 'Le sujet de mémoire "'.$name.'" a bien été supprimé !');

        return $this->redirect($this->generateUrl('sujet'));
    }
    
    public function validateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository('StagiaAppBundle:Sujet')->find($id);

        if (!$sujet) {
            throw $this->createNotFoundException('Sujet introuvable');
        }
        $sujet->valider();
        $em->flush();
        $this->addFlash('success', 'Le sujet de mémoire "'.$sujet->getNom().'" a bien été validé !');

        return $this->redirect($this->generateUrl('sujet'));
    }
    
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(!$request->isXmlHttpRequest()) {
            return $this->redirect($this->generateUrl('sujet'));
        }
        $recherche = $request->get('recherche');
        $sujets = null;
        if($recherche)
        {
           $qb = $em->createQueryBuilder();

           $qb->select('s')
              ->from('StagiaAppBundle:Sujet', 's')
              ->where("s.nom LIKE :recherche ")
              ->orderBy('s.nom', 'ASC')
              ->setParameter('recherche', '%'.$recherche.'%');

           $query = $qb->getQuery();              
           $sujets = $query->getResult();
        }
        else
        {
            $sujets = $em->getRepository('StagiaAppBundle:Sujet')->findAll();
        }
        return $this->render('StagiaAppBundle:Sujet:listeSujet.html.twig', array('sujets' => $sujets)); 
    }
}
