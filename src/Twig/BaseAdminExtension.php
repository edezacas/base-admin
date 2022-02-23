<?php

namespace EDC\BaseAdminBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class BaseAdminExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('contains', [$this, 'contains']),
        ];
    }

    public function contains(string $haystack, string $needle): bool
    {
        return str_contains($haystack, $needle);
    }
}
