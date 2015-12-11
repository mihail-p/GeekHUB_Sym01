<?php

namespace AppBundle\DataFixtures\ORM;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;
class FixturesLoader extends DataFixtureLoader
{
    /**
     * Returns an array of file paths to fixtures
     *
     * @return array<string>
     */
    protected function getFixtures()
    {
        $env = $this->container->get('kernel')->getEnvironment();
        if ($env == 'test') {
            return [
                __DIR__ . '/Tests/players.yml',
/*                __DIR__ . '/DataForTests/categories.yml',
                __DIR__ . '/DataForTests/users.yml', */
            ];
        }
        return [
            __DIR__ . '/Data/players.yml',
/*            __DIR__ . '/Data/categories.yml',
            __DIR__ . '/Data/users.yml', */
        ];
    }
}