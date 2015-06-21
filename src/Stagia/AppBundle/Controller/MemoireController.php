<?php

namespace Stagia\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stagia\AppBundle\Entity\Memoire;
use Stagia\AppBundle\Form\MemoireType;

/**
 * Memoire controller.
 *
 */
class MemoireController extends Controller
{

    /**
     * Lists all Memoire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StagiaAppBundle:Memoire')->findAll();

        return $this->render('StagiaAppBundle:Memoire:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Memoire entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Memoire();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUtilisateurCreateur($this->getUser());
            $entity->setDateCreation(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('memoire_show', array('id' => $entity->getId())));
        }

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Memoire entity.
     *
     * @param Memoire $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Memoire $entity)
    {
        $form = $this->createForm(new MemoireType(), $entity, array(
            'action' => $this->generateUrl('memoire_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Memoire entity.
     *
     */
    public function newAction()
    {
        $entity = new Memoire();
        $form   = $this->createCreateForm($entity);

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Memoire entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Memoire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StagiaAppBundle:Memoire:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Memoire entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Memoire entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Memoire entity.
    *
    * @param Memoire $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Memoire $entity)
    {
        $form = $this->createForm(new MemoireType(), $entity, array(
            'action' => $this->generateUrl('memoire_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Memoire entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Memoire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('memoire_edit', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Memoire entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Memoire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('memoire'));
    }

    /**
     * Creates a form to delete a Memoire entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('memoire_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
