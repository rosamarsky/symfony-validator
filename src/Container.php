<?php
declare(strict_types=1);

namespace Rosamarsky\Validator;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

interface Container
{
    /**
     * @param string $className
     */
    public function make(string $className);
}