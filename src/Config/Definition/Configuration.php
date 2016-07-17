<?php

/*
 * This file is part of Symplify
 * Copyright (c) 2015 Tomas Votruba (http://tomasvotruba.cz).
 */

namespace Symplify\DefaultAutowire\Config\Definition;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symplify\DefaultAutowire\SymplifyDefaultAutowireBundle;

final class Configuration implements ConfigurationInterface
{
    /**
     * @var string[]
     */
    private $defaultAutowireTypes = [
        'Doctrine\ORM\EntityManager' => 'doctrine.orm.default_entity_manager',
        'Doctrine\ORM\EntityManagerInterface' => 'doctrine.orm.default_entity_manager',
        'Doctrine\Portability\Connection' => 'database_connection',
        'Symfony\Component\EventDispatcher\EventDispatcher' => 'event_dispatcher',
        'Symfony\Component\EventDispatcher\EventDispatcherInterface' => 'event_dispatcher',
        'Symfony\Component\Translation\TranslatorInterface' => 'translator',
    ];

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root(SymplifyDefaultAutowireBundle::ALIAS);

        $rootNode->children()
            ->arrayNode('autowire_types')
                ->defaultValue($this->defaultAutowireTypes)
                ->prototype('scalar')
            ->end();

        return $treeBuilder;
    }
}
