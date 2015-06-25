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
        $memoire = new Memoire();
        $form = $this->createCreateForm($memoire);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $memoire->setUtilisateurCreateur($this->getUser());
            $memoire->setDateCreation(new \DateTime());
            $em->persist($memoire);
            $em->flush();

            return $this->redirect($this->generateUrl('memoire_show', array('id' => $memoire->getId())));
        }

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'entity' => $memoire,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Memoire entity.
     *
     * @param Memoire $memoire The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Memoire $memoire)
    {
        $form = $this->createForm(new MemoireType(), $memoire, array(
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
        $memoire = new Memoire();
        $form   = $this->createCreateForm($memoire);

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'entity' => $memoire,
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

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Unable to find Memoire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StagiaAppBundle:Memoire:show.html.twig', array(
            'entity'      => $memoire,
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

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Unable to find Memoire entity.');
        }

        $editForm = $this->createEditForm($memoire);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'entity'      => $memoire,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Memoire entity.
    *
    * @param Memoire $memoire The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Memoire $memoire)
    {
        $form = $this->createForm(new MemoireType(), $memoire, array(
            'action' => $this->generateUrl('memoire_update', array('id' => $memoire->getId())),
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

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Unable to find Memoire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($memoire);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('memoire_edit', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'entity'      => $memoire,
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
            $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

            if (!$memoire) {
                throw $this->createNotFoundException('Unable to find Memoire entity.');
            }

            $em->remove($memoire);
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
