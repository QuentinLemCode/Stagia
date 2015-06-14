<?php

namespace Stagia\AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class CompetenceTranformer implements DataTransformerInterface{

    public function transform($competences) {
        if (!$competences) {
            $competences = array();
        }
            return implode(', ', $competences);
    }
    
    public function reverseTransform($competences) {
        if (!$competences) {
            $competences = '';
        }
 
        return array_filter(array_map('trim', explode(',', $competences)));
    }


}
