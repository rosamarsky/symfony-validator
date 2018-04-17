<?php
declare(strict_types=1);

namespace Rosamarsky\Validator\DependencyInjection;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ValidatorBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ValidatorExtension();
    }
}