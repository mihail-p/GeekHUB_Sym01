<?php

namespace AppBundle\DataFixtures\ORM;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;
/*use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader; */
class FixturesLoader extends DataFixtureLoader /* AbstractLoader */
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
                __DIR__ . '/Tests/team.yml',
                __DIR__ . '/Tests/players.yml',
                __DIR__ . '/Tests/coaches.yml',
            ];
        }
        return [
            __DIR__ . '/Data/team.yml',
            __DIR__ . '/Data/players.yml',
            __DIR__ . '/Data/coaches.yml',
        ];
    }
}