<?php


namespace EDC\BaseAdminBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;

class EDCBaseAdminBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
