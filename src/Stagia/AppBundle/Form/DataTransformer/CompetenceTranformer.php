<?php

namespace Stagia\AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Stagia\AppBundle\Entity\Competence;

class CompetenceTranformer implements DataTransformerInterface{

    public function transform($competences) {
        if (!$competences) {
            $competences = array();
        }
 
        return implode(', ', $competences->getValues()); // concatenate the tags to one string
    }
    
    public function reverseTransform($competences) {
        if (!$competences) {
            $competences = '';
        }
 
        $array = array_filter(array_map('trim', explode(',', $competences)));   
        $s = array();
        foreach($array as $a)
        {
            $s[] = new Competence($a);
        }
        return $s;
    }


}
