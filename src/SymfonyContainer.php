<?php
declare(strict_types=1);

namespace Rosamarsky\Validator;

use Symfony\Component\DependencyInjection\ContainerInterface;

class SymfonyContainer implements Container
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $className
     * @return object
     */
    public function make(string $className)
    {
        return $this->container->get($className);
    }
}