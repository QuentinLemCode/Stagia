<?php

namespace Stagia\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stagia\AppBundle\Entity\Stage;
use Stagia\AppBundle\Form\StageType;

/**
 * Stage controller.
 *
 */
class StageController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stages = $em->getRepository('StagiaAppBundle:Stage')->findAll();

        return $this->render('StagiaAppBundle:Stage:index.html.twig', array(
            'stages' => $stages,
        ));
    }

    public function createAction(Request $request)
    {
        $stage = new Stage();
        $form = $this->createCreateForm($stage);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $stage->setUtilisateurCreateur($this->getUser());
            $stage->setDatePublication(new \DateTime());
            $em->persist($stage);
            $em->flush();
            $this->addFlash('success', 'Annonce enregistré !');

            return $this->redirect($this->generateUrl('stage_show', array('id' => $stage->getId())));
        }

        return $this->render('StagiaAppBundle:Stage:new.html.twig', array(
            'stage' => $stage,
            'form'   => $form->createView(),
        ));
    }

    private function createCreateForm(Stage $stage)
    {
        $form = $this->createForm(new StageType(), $stage);
        return $form;
    }

    public function newAction()
    {
        $stage = new Stage();
        $form   = $this->createCreateForm($stage);

        return $this->render('StagiaAppBundle:Stage:new.html.twig', array(
            'stage' => $stage,
            'form'   => $form->createView(),
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $stage = $em->getRepository('StagiaAppBundle:Stage')->find($id);

        if (!$stage) {
            throw $this->createNotFoundException('Stage introuvable');
        }

        return $this->render('StagiaAppBundle:Stage:show.html.twig', array(
            'stage'      => $stage
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $stage = $em->getRepository('StagiaAppBundle:Stage')->find($id);

        if (!$stage) {
            throw $this->createNotFoundException('Stage introuvable');
        }

        $editForm = $this->createEditForm($stage);

        return $this->render('StagiaAppBundle:Stage:edit.html.twig', array(
            'stage'      => $stage,
            'form'   => $editForm->createView(),
        ));
    }

    private function createEditForm(Stage $stage)
    {
        $form = $this->createForm(new StageType(), $stage);
        return $form;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $stage = $em->getRepository('StagiaAppBundle:Stage')->find($id);

        if (!$stage) {
            throw $this->createNotFoundException('Stage introuvable');
        }
        $editForm = $this->createEditForm($stage);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash('success','Stage "'.$stage->getTitre().'" modifié !');

            return $this->redirect($this->generateUrl('stage_show', array('id' => $id)));
        }

        return $this->render('StagiaAppBundle:Stage:edit.html.twig', array(
            'stage'      => $stage,
            'form'   => $editForm->createView()
        ));
    }
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $stage = $em->getRepository('StagiaAppBundle:Stage')->find($id);
        $name = $stage->getTitre();

        if (!$stage) {
            throw $this->createNotFoundException('Stage introuvable');
        }
        $em->remove($stage);
        $em->flush();
        $this->addFlash('success', 'Le stage "'.$name.'" a bien été supprimé !');

        return $this->redirect($this->generateUrl('stage'));
    }
}
