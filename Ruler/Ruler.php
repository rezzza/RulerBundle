<?php

namespace Rezzza\RulerBundle\Ruler;

use Rezzza\RulerBundle\Ruler\ContextBuilder\Container as ContextBuilderContainer;
use Rezzza\RulerBundle\Ruler\Event\Container as EventContainer;

/**
 * Ruler
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Ruler extends \Hoa\Ruler\Ruler
{
    /**
     * @var ContextBuilderContainer
     */
    private $contextBuilderContainer;

    /**
     * @var EventContainer
     */
    private $eventContainer;

    /**
     * @var array
     */
    private $functionCollections = array();

    /**
     * @var boolean
     */
    private $initialized = false;

    /**
     * @{inheritdoc}
     */
    public function assert ( $data, \Hoa\Ruler\Context $context = null)
    {
        try {
            if (!$this->isInitialized()) {
                $this->initialize();
            }

            return parent::assert($data, $context);
        } catch (Exception\FalseAssertionException $e) {
            return false;
        }
    }

    /**
     * Add function collections given via Symfony's tags
     */
    public function initialize()
    {
        foreach ($this->functionCollections as $functionCollection) {
            foreach ($functionCollection->getFunctions() as $name => $function) {
                $this->getDefaultAsserter()->setOperator($name, $function);
            }
        }
    }

    /**
     * @return boolean
     */
    public function isInitialized()
    {
        return $this->initialized;
    }

    /**
     * @param string $key key
     *
     * @return \Hoa\Ruler\Context
     */
    public function createContext($key = 'default')
    {
        if (!$this->contextBuilderContainer->has($key)) {
            throw new \InvalidArgumentException(
                sprintf('Context with key "%s" does not exists, available context builders are : %s', $key, implode(', ', array_keys($this->contextBuilderContainer->all())))
            );
        }

        $cb = $this->contextBuilderContainer->get($key);

        return $cb->build();
    }

    /**
     * @param string $event event
     *
     * @return \Hoa\Ruler\Context
     */
    public function createContextFromEvent($event)
    {
        if (!$this->eventContainer->has($event)) {
            throw new \InvalidArgumentException(
                sprintf('Event with key "%s" does not exists, available events are : %s', $event, implode(', ', array_keys($this->eventContainer->all())))
            );
        }

        $event = $this->eventContainer->get($event);

        return $this->createContext($event->getContextBuilder());
    }

    /**
     * @param ContextBuilderContainer $cbc cbc
     */
    public function setContextBuilderContainer(ContextBuilderContainer $cbc)
    {
        $this->contextBuilderContainer = $cbc;
    }

    /**
     * @param EventContainer $ec ec
     */
    public function setEventContainer(EventContainer $ec)
    {
        $this->eventContainer = $ec;
    }

    /**
     * @param FunctionCollectionInterface $functionCollection functionCollection
     */
    public function addFunctionCollection(FunctionCollectionInterface $functionCollection)
    {
        $this->functionCollections[] = $functionCollection;
    }
}
