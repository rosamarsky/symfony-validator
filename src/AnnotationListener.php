<?php
declare(strict_types=1);

namespace Rosamarsky\Validator;

use Rosamarsky\Validator\Annotations\Validate;
use Doctrine\Common\Annotations\Reader;
use ReflectionObject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class AnnotationListener
{
    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param Reader $annotationReader
     * @param Container $container
     */
    public function __construct(Reader $annotationReader, Container $container)
    {
        $this->annotationReader = $annotationReader;
        $this->container = $container;
    }

    /**
     * Listen to all controllers
     *
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        $request = $event->getRequest();

        // Exit if there is no controller
        if (! is_array($controller)) {
            return;
        }

        $validateAnnotation = $this->getValidateAnnotation($controller);

        // Exit if there is no annotation @Validate
        if (! $validateAnnotation) {
            return;
        }

        /** @var Validation $validator */
        $validator = $this->container->make($validateAnnotation->getValidationClassName());

        $validator->validate($request);
    }

    /**
     * @param array $controller
     *
     * @return Validate|null
     */
    private function getValidateAnnotation(array $controller):? Validate
    {
        /** @var Controller $controllerObject */
        $controllerObject = new ReflectionObject($controller[0]);
        $method = $controllerObject->getMethod($controller[1]);

        return $this->annotationReader->getMethodAnnotation($method, Validate::class);
    }
}