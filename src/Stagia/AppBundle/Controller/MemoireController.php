<?php

namespace Stagia\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stagia\AppBundle\Entity\Memoire;
use Stagia\AppBundle\Form\MemoireType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Memoire controller.
 *
 */
class MemoireController extends Controller
{

    /**
     * Lists all Memoire memoires.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $memoires = $em->getRepository('StagiaAppBundle:Memoire')->findAll();

        return $this->render('StagiaAppBundle:Memoire:index.html.twig', array(
            'memoires' => $memoires,
        ));
    }
    /**
     * Creates a new Memoire memoire.
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
            $this->addFlash('success', 'Mémoire créé avec succès !');
            return $this->redirect($this->generateUrl('memoire_show', array('id' => $memoire->getId())));
        }

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'memoire' => $memoire,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Memoire memoire.
     *
     * @param Memoire $memoire The memoire
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Memoire $memoire)
    {
        $form = $this->createForm(new MemoireType(), $memoire);

        return $form;
    }

    /**
     * Displays a form to create a new Memoire memoire.
     *
     */
    public function newAction()
    {
        $memoire = new Memoire();
        $form   = $this->createCreateForm($memoire);

        return $this->render('StagiaAppBundle:Memoire:new.html.twig', array(
            'memoire' => $memoire,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Memoire memoire.
     *
     */
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

    /**
     * Displays a form to edit an existing Memoire memoire.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Unable to find Memoire memoire.');
        }

        $editForm = $this->createEditForm($memoire);

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'memoire'      => $memoire,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Memoire memoire.
    *
    * @param Memoire $memoire The memoire
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Memoire $memoire)
    {
        $form = $this->createForm(new MemoireType(), $memoire);
        return $form;
    }
    /**
     * Edits an existing Memoire memoire.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $memoire = $em->getRepository('StagiaAppBundle:Memoire')->find($id);

        if (!$memoire) {
            throw $this->createNotFoundException('Unable to find Memoire memoire.');
        }
        $editForm = $this->createEditForm($memoire);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Mémoire modifié avec succès');

            return $this->redirect($this->generateUrl('memoire_show', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Memoire:edit.html.twig', array(
            'memoire'      => $memoire,
            'edit_form'   => $editForm->createView()
        ));
    }
    /**
     * Deletes a Memoire memoire.
     *
     */
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
