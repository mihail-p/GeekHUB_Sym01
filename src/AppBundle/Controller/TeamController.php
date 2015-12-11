<?phpnamespace AppBundle\Controller;use Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearQueryCacheDoctrineCommand;use Symfony\Bundle\FrameworkBundle\Controller\Controller;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\HttpFoundation\Request;use AppBundle\Model\TeamF;use AppBundle\Entity\Team;use AppBundle\Repository;use AppBundle\Entity\Players;use AppBundle\Entity\Coaches;Class TeamController extends Controller{    private $teamAll = array('France', 'Iceland', 'Czech Republic', 'Turkey', 'Belgium', 'Wales', 'Spain', 'Slovakia',        'Germany', 'Poland', 'England', 'Switzerland', 'Northern Ireland', 'Romania', 'Austria', 'Russia',        'Italy', 'Croatia', 'Portugal', 'Albania', 'Hungary', 'Republic of Ireland', 'Ukraine', 'Sweden');    private $flagAll = array('fr', 'il', 'CR', 'tk', 'be', 'wa', 'sp', 'slo', 'gr', 'pl', 'en', 'sl', 'NI', 'ro',        'au', 'ru', 'it', 'cr', 'po', 'al', 'hu', 'RoI', 'ua', 'sw');    /**     * @Route("/", name="root")     * @return Response     */    public function rootAction()    {        $flagAll = $this->flagAll;        $teamAll = $this->teamAll;        $groupR = range('a', 'g');        $curGr = 1;        $rand = range(0, 23);        $number = 1;        for ($i = 0; $i <= 23; $i++) {            $group = $groupR[$curGr];            $country = $teamAll[$i];            $flag = $flagAll[$i];            $num = $number;            $number++;            if ($number >= 5) {                $number = 1;                $curGr++;            }            $rand[$i] = ['country' => $country, 'flag' => $flag, 'number' => $num, 'group' => $group];        }        return $this->render('soccer/root.html.twig', array('rand' => $rand));    }    /**     * @Route("/team/{team}", defaults={"team" = "Bulgaria"}, name="team")     */    public function teamShowAction($team, Request $request)    {        $repositoryT = $this->getDoctrine()->getRepository('AppBundle:Team');        $trueRout = $this->trueCountry($team);        $teamObj = $repositoryT->findOneByCountry($team);/*      testing...        $teamObjID = $repositoryT->find(127);        $listPlayers = $teamObjID->getPlayers()->last();        $listPlayers = $repositoryP->findAll();        $listCoaches = $repositoryC->findAll(); */        $lastMatches = 'For the first time, 24 sides will contest the UEFA European Championship when it takes place between 10 June and 10 July 2016.            The Stade de France will stage the final            The inaugural final tournament in France in 1960 was a four-team affair, involving four matches played over five days at two venues. For UEFA EURO 2016, France\'s third finals having won on home turf in 1984, 24 sides will contest 51 games over 32 days at ten venues – in Bordeaux, Lens, Lille, Lyon, Marseille, Nice, Paris, Saint-Denis, Saint-Etienne and Toulouse.';        return $this->render('soccer/team.html.twig',            array('trueRout' => $trueRout, 'team' => $team, 'lastMatches' => $lastMatches, 'teamObj' => $teamObj                /*, 'listPlayers' => $listPlayers*/));    }    /**     * @Route("/team/{team}/player/{player}", defaults={"team" = "Bulgaria"}, name="player")     */    public function playerShowAction($team, $player)    {        $trueRout = $this->trueCountry($team);        $em = $this->getDoctrine()->getManager();        $personObj = $em->getRepository('AppBundle:Players')        ->selectPlayerByCountry($team, $player);        return $this->render('soccer/player.html.twig',            array('trueRout' => $trueRout, 'team' => $team, 'player' => $player, 'personObj' => $personObj));    }    /**     * @Route("/team/{team}/coach/{coach}", defaults={"team" = "Bulgaria"}, name="coach")     */    public function coachShowAction($team, $coach)    {        $trueRout = $this->trueCountry($team);        $em = $this->getDoctrine()->getManager();        $personObj = $em->getRepository('AppBundle:Coaches')            ->selectCoachByCountry($team, $coach);        return $this->render('soccer/coach.html.twig',            array('trueRout' => $trueRout, 'team' => $team, 'coach' => $coach, 'personObj' => $personObj));    }    /**     * @Route("/flag/{flag}", defaults={"flag" = "Bulgaria"}, name="flag")     */    public function flagShowAction($flag, Request $request)    {        $trueRout = $this->trueCountry($flag);        $aboutObj = new TeamF();        return $this->render('soccer/flag.html.twig',            array('trueRout' => $trueRout, 'flag' => $flag, 'aboutObj' => $aboutObj));    }    private function trueCountry($country)    {        $teamAll = $this->teamAll;        if (in_array($country, $teamAll)) {            $bool = True;        } else {            $bool = False;        }        return $bool;    }}