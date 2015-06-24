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

        $entities = $em->getRepository('StagiaAppBundle:Sujet')->findAll();

        return $this->render('StagiaAppBundle:Sujet:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    public function createAction(Request $request)
    {
        $entity = new Sujet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if(!$this->getUser())
        {
            throw $this->createAccessDeniedException("Vous devez être connecté pour poster un sujet");
        }
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUtilisateurCreateur($this->getUser());
            $entity->setDateCreation(new \DateTime);
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Sujet de mémoire enregistré !');
            return $this->redirect($this->generateUrl('sujet_show', array('id' => $entity->getId())));
        }

        return $this->render('StagiaAppBundle:Sujet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    private function createCreateForm(Sujet $entity)
    {
        $form = $this->createForm(new SujetType(), $entity, array(
            'action' => $this->generateUrl('sujet_create'),
            'method' => 'POST',
        ));
        return $form;
    }

    
    public function newAction()
    {
        $entity = new Sujet();
        $form   = $this->createCreateForm($entity);

        return $this->render('StagiaAppBundle:Sujet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Sujet')->find($id);
        
        $commentaires = $entity->getCommentaires();
        
        $commentaire = new Commentaire();
        
        $commentaireform = $form = $this->createForm(new CommentaireType(), $commentaire, array(
            'action' => $this->generateUrl('commentaire_post', array(
                'sujet_id' => $entity->getId()
            )),
            'method' => 'POST',
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sujet entity.');
        }
        return $this->render('StagiaAppBundle:Sujet:show.html.twig', array(
            'commentaireform' => $commentaireform->createView(),
            'commentaires' => $commentaires,
            'entity'      => $entity
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Sujet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sujet entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('StagiaAppBundle:Sujet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    private function createEditForm(Sujet $entity)
    {
        $form = $this->createForm(new SujetType(), $entity, array(
            'action' => $this->generateUrl('sujet_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Sujet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sujet entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sujet_edit', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Sujet:edit.html.twig', array(
            'entity'      => $entity,
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
}
