<?php

namespace ThirtyOne\MemberBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ThirtyOneMemberBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
