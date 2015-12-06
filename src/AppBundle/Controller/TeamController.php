<?phpnamespace AppBundle\Controller;use Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearQueryCacheDoctrineCommand;use Symfony\Bundle\FrameworkBundle\Controller\Controller;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\HttpFoundation\Request;use AppBundle\Model\TeamF;use AppBundle\Entity\Team;use AppBundle\Entity\Players;Class TeamController extends Controller{    private $teamAll = array('France', 'Iceland', 'Czech Republic', 'Turkey', 'Belgium', 'Wales', 'Spain', 'Slovakia',        'Germany', 'Poland', 'England', 'Switzerland', 'Northern Ireland', 'Romania', 'Austria', 'Russia',        'Italy', 'Croatia', 'Portugal', 'Albania', 'Hungary', 'Republic of Ireland', 'Ukraine', 'Sweden');    private $flagAll = array('fr', 'il', 'CR', 'tk', 'be', 'wa', 'sp', 'slo', 'gr', 'pl', 'en', 'sl', 'NI', 'ro',        'au', 'ru', 'it', 'cr', 'po', 'al', 'hu', 'RoI', 'ua', 'sw');    /**     * @Route("/", name="root")     * @return Response     */    public function rootAction()    {        $flagAll = $this->flagAll;        $teamAll = $this->teamAll;        $groupR = range('a', 'g');        $curGr = 1;        $rand = range(0, 23);        $number = 1;        for ($i = 0; $i <= 23; $i++) {            $group = $groupR[$curGr];            $country = $teamAll[$i];            $flag = $flagAll[$i];            $num = $number;            $number++;            if ($number >= 5) {                $number = 1;                $curGr++;            }            $rand[$i] = ['country' => $country, 'flag' => $flag, 'number' => $num, 'group' => $group];        }        return $this->render('soccer/root.html.twig', array('rand' => $rand));    }    /**     * @Route("/team/{team}", defaults={"team" = "Bulgaria"}, name="team")     */    public function teamShowAction($team, Request $request)    {        $trueRout = $this->trueCountry($team);        $listObj = new TeamF();        $listPlayers = $listObj->fPersonStr('10');        $listCoaches = $listObj->fPersonStr('4');        $lastMatches = 'For the first time, 24 sides will contest the UEFA European Championship when it takes place between 10 June and 10 July 2016.            The Stade de France will stage the final            The inaugural final tournament in France in 1960 was a four-team affair, involving four matches played over five days at two venues. For UEFA EURO 2016, France\'s third finals having won on home turf in 1984, 24 sides will contest 51 games over 32 days at ten venues – in Bordeaux, Lens, Lille, Lyon, Marseille, Nice, Paris, Saint-Denis, Saint-Etienne and Toulouse.';        return $this->render('soccer/team.html.twig',            array('trueRout' => $trueRout, 'listPlayers' => $listPlayers, 'team' => $team, 'listCoaches' => $listCoaches,                'lastMatches' => $lastMatches));    }    /**     * @Route("/team/{team}/player/{player}", defaults={"team" = "Bulgaria"}, name="player")     */    public function playerShowAction($team, $player, Request $request)    {        $trueRout = $this->trueCountry($team);        $personObj = new TeamF();        return $this->render('soccer/player.html.twig',            array('trueRout' => $trueRout, 'team' => $team, 'player' => $player, 'personObj' => $personObj));    }    /**     * @Route("/team/{team}/coach/{coach}", defaults={"team" = "Bulgaria"}, name="coach")     */    public function coachShowAction($team, $coach, Request $request)    {        $trueRout = $this->trueCountry($team);        $personObj = new TeamF();        return $this->render('soccer/coach.html.twig',            array('trueRout' => $trueRout, 'team' => $team, 'coach' => $coach, 'personObj' => $personObj));    }    /**     * @Route("/flag/{flag}", defaults={"flag" = "Bulgaria"}, name="flag")     */    public function flagShowAction($flag, Request $request)    {        $trueRout = $this->trueCountry($flag);        $aboutObj = new TeamF();        return $this->render('soccer/flag.html.twig',            array('trueRout' => $trueRout, 'flag' => $flag, 'aboutObj' => $aboutObj));    }    /**     * @Route("/createTeams", name="createT")     */    public function createTeamsAction()    {        $em = $this->getDoctrine()->getManager();        $repository = $this->getDoctrine()->getRepository('AppBundle:Team');        // ---- create list Countries ------        foreach ($this->teamAll as $item) {            if (!$repository->findOneByCountry($item)) {                $teams = new Team();                $teams->setCountry($item);                $em->persist($teams);            }        }        $teamAll = $repository->findAll();        // ---- create list Players ------        $query = $em->createQuery(            'SELECT p.age FROM AppBundle:Players p WHERE p.age > 18'        );        $res = $query-> setMaxResults(1)->getOneOrNullResult();        if ($res < 1) {            foreach ($teamAll as $team) {                for ($i = 1; $i <= 10; $i++) {                    $players = new Players();                    $fake = new TeamF();                    $age = $fake->age();                    $players->setAge($age);                    $fName = $fake->fPersonStr();                    $players->setName($fName);                    $fBio = $fake->fTextStr();                    $players->setBiography($fBio);                    $players->setTeam($team);                    $em->persist($team);                    $em->persist($players);                }            }            $em->flush();        }        // ---- create list Coaches ------/*        $query = $em->createQuery(            'SELECT p.age FROM AppBundle:Players p WHERE p.age > 18'        );        $res = $query-> setMaxResults(1)->getOneOrNullResult();        if ($res < 1) {            foreach ($teamAll as $team) {                for ($i = 1; $i <= 10; $i++) {                    $players = new Players();                    $fake = new TeamF();                    $age = $fake->age();                    $players->setAge($age);                    $fName = $fake->fPersonStr();                    $players->setName($fName);                    $fBio = $fake->fTextStr();                    $players->setBiography($fBio);                    $players->setTeam($team);                    $em->persist($team);                    $em->persist($players);                }            }            $em->flush();        } */        $res = $repository->findOneByCountry('Sweden');        return $this->render(':soccer:createTeams.html.twig', array('country' => $res, 'teamall' => $teamAll));    }    private function trueCountry($country)    {        $teamAll = $this->teamAll;        if (in_array($country, $teamAll)) {            $bool = True;        } else {            $bool = False;        }        return $bool;    }}