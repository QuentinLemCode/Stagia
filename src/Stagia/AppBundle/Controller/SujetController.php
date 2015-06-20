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

    /**
     * Lists all Sujet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StagiaAppBundle:Sujet')->findAll();

        return $this->render('StagiaAppBundle:Sujet:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Sujet entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Sujet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid() && !empty($this->getUser())) {
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

    /**
     * Creates a form to create a Sujet entity.
     *
     * @param Sujet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sujet $entity)
    {
        $form = $this->createForm(new SujetType(), $entity, array(
            'action' => $this->generateUrl('sujet_create'),
            'method' => 'POST',
        ));
        return $form;
    }

    /**
     * Displays a form to create a new Sujet entity.
     *
     */
    public function newAction()
    {
        $entity = new Sujet();
        $form   = $this->createCreateForm($entity);

        return $this->render('StagiaAppBundle:Sujet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sujet entity.
     *
     */
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StagiaAppBundle:Sujet:show.html.twig', array(
            'commentaireform' => $commentaireform->createView(),
            'commentaires' => $commentaires,
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Sujet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Sujet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sujet entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StagiaAppBundle:Sujet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Sujet entity.
    *
    * @param Sujet $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sujet $entity)
    {
        $form = $this->createForm(new SujetType(), $entity, array(
            'action' => $this->generateUrl('sujet_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sujet entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Sujet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sujet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sujet_edit', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Sujet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Sujet entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StagiaAppBundle:Sujet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sujet entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sujet'));
    }

    /**
     * Creates a form to delete a Sujet entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sujet_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
