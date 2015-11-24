<?phpnamespace AppBundle\Controller;use Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearQueryCacheDoctrineCommand;use Symfony\Bundle\FrameworkBundle\Controller\Controller;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\HttpFoundation\Request;Class TeamController extends Controller{    /**     * @Route("/team/{team}", defaults={"team" = "Bulgaria"}, name="team")     */    public function teamShowAction($team, Request $request)    {        $trueRout = $this->trueCountry($team);        $listPlayers = $this->listStr('player', '10');        $listCoaches = $this->listStr('coach', '4');        $lastMatches = 'For the first time, 24 sides will contest the UEFA European Championship when it takes place between 10 June and 10 July 2016.            The Stade de France will stage the final            The inaugural final tournament in France in 1960 was a four-team affair, involving four matches played over five days at two venues. For UEFA EURO 2016, France\'s third finals having won on home turf in 1984, 24 sides will contest 51 games over 32 days at ten venues – in Bordeaux, Lens, Lille, Lyon, Marseille, Nice, Paris, Saint-Denis, Saint-Etienne and Toulouse.';        return $this->render('soccer/team.html.twig',            array('trueRout' => $trueRout, 'listPlayers' => $listPlayers, 'team' => $team, 'listCoaches' => $listCoaches, 'lastMatches' => $lastMatches));    }    /**     * @Route("/team/{team}/player/{player}", defaults={"team" = "Bulgaria"}, name="player")     */    public function playerShowAction($team, $player, Request $request)    {        $trueRout = $this->trueCountry($team);        $biography = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur debitis dolorem eaque eius enim harum inventore magni non odio optio porro quis repellat repellendus, saepe sint soluta tenetur vero?';        return $this->render('soccer/player.html.twig',            array('trueRout' => $trueRout, 'team' => $team, 'player' => $player, 'biography' => $biography));    }    /**     * @Route("/team/{team}/coach/{coach}", defaults={"team" = "Bulgaria"}, name="coach")     */    public function coachShowAction($team, $coach, Request $request)    {        $trueRout = $this->trueCountry($team);        $biography = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur debitis dolorem eaque eius enim harum inventore magni non odio optio porro quis repellat repellendus, saepe sint soluta tenetur vero?';        return $this->render('soccer/coach.html.twig',            array('trueRout' => $trueRout, 'team' => $team, 'coach' => $coach, 'biography' => $biography));    }     /**     * @Route("/flag/{flag}", defaults={"flag" = "Bulgaria"}, name="flag")     */    public function flagShowAction($flag, Request $request)    {        $trueRout = $this->trueCountry($flag);        $about = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium adipisci at, culpa facilis fuga id illo incidunt iste iure minus modi nihil, odio pariatur, possimus quae qui vel voluptatum';        return $this->render('soccer/flag.html.twig',            array('trueRout' => $trueRout, 'flag' => $flag, 'about' => $about));    }    private function listStr($person, $num)    {        $list = [];        for ($i = 1; $i <= $num; $i++) {            $list[$i] = ($person.$i);        }        return $list;    }    private function trueCountry($country)    {            $teamAll = array('France', 'Iceland', 'Czech Republic', 'Turkey', 'Belgium', 'Wales', 'Spain', 'Slovakia',            'Germany', 'Poland', 'England', 'Switzerland', 'Northern', 'Ireland', 'Romania', 'Austria', 'Russia',            'Italy', 'Croatia', 'Portugal', 'Albania', 'Hungary', 'Republic of Ireland', 'Ukraine', 'Sweden');        if (in_array($country, $teamAll)) {$bool=True;}        else {$bool = False;}        return $bool;    }}