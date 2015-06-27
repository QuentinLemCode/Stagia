<?php

namespace Stagia\UtilisateurBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StagiaUtilisateurBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
