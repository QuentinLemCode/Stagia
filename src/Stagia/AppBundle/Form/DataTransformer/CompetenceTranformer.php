<?php

namespace Stagia\AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Stagia\AppBundle\Entity\Competence;

class CompetenceTranformer implements DataTransformerInterface{

    public function transform($competences) {
        if (!$competences) {
            $competences = array();
        }
        
        if(!empty(($competences)))
        {
            return implode(', ', $competences->getValues());
        }
        else
        {
            return '';
        }
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
