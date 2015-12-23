<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\TeamF;
use AppBundle\Entity\Team;
use AppBundle\Entity\Players;
use AppBundle\Entity\Coaches;

class GeneratorControler extends Controller
{
    private $teamAll = array('France', 'Iceland', 'Czech Republic', 'Turkey', 'Belgium', 'Wales', 'Spain', 'Slovakia',
        'Germany', 'Poland', 'England', 'Switzerland', 'Northern Ireland', 'Romania', 'Austria', 'Russia',
        'Italy', 'Croatia', 'Portugal', 'Albania', 'Hungary', 'Republic of Ireland', 'Ukraine', 'Sweden');

    /**
     * @Route("/createTeams", name="createT")
     */
    public function createTeamsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Team');
        $lastTeam = '';
        $lastObj = '';

        // ---- create list Countries ------
        foreach ($this->teamAll as $item) {
            if (!$repository->findOneByCountry($item)) {
                $teams = new Team();
                $teams->setCountry($item);
                $em->persist($teams);
            }
            $lastTeam = $item;
        }
        $teamAll = $repository->findAll();

        // ---- create list Players ------
        /* $query = $em->createQuery(
            'SELECT p.age FROM AppBundle:Players p WHERE p.age > 18')
            ->setMaxResults(1)
            ->getOneOrNullResult();*/
        $countP = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Players p')
        ->getSingleScalarResult();
        if ($countP < 1) {
            foreach ($teamAll as $team) {
                for ($i = 1; $i <= 10; $i++) {
                    $players = new Players();
                    $fake = new TeamF();

                    $age = $fake->age(18, 30);
                    $players->setAge($age);
                    $fName = $fake->fPersonStr();
                    $players->setName($fName);
                    $fBio = $fake->fTextStr();
                    $players->setBiography($fBio);
                    $players->setTeam($team);

                    $em->persist($team);
                    $em->persist($players);
                }
            }
            $em->flush();
        }
        // ---- create list Coaches ------
        /*$query = $em->createQuery(
            'SELECT c.age FROM AppBundle:Coaches c WHERE c.age > 27'
        );*/
        $countC = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Coaches p')
            ->getSingleScalarResult();
        /* $res = $query->setMaxResults(1)->getOneOrNullResult(); */
        if ($countC < 1) {
            foreach ($teamAll as $team) {
                for ($i = 1; $i <= 4; $i++) {
                    $coaches = new Coaches();
                    $fake = new TeamF();

                    $age = $fake->age(27, 45);
                    $coaches->setAge($age);
                    $fName = $fake->fPersonStr();
                    $coaches->setName($fName);
                    $fBio = $fake->fTextStr();
                    $coaches->setBiography($fBio);
                    $coaches->setTeam($team);

                    //$em->persist($team);
                    $em->persist($coaches);
                }
            }
            $em->flush();
        }
        $res = $repository->findOneByCountry($lastTeam);

        return $this->render(':soccer:createTeams.html.twig', array('country' => $res, 'lastTeam' => $lastTeam,
            'lastObj' => $lastObj, 'countP' => $countP, 'countC' => $countC, 'teamAll' => $teamAll));

    }
}