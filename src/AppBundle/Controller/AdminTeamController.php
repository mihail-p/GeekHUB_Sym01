<?phpnamespace AppBundle\Controller;use Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearQueryCacheDoctrineCommand;use Symfony\Bundle\FrameworkBundle\Controller\Controller;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\HttpFoundation\Request;use AppBundle\Form\TeamType;use AppBundle\Entity\Team;Class AdminTeamController extends Controller{    /**     * @Route("/admin/{team}/add", defaults={"team" = "France"}, name="adm_team_add")     */    public function teamAddAction($team, Request $request)    {        $teamObj = new Team();        $form = $this->createForm(new TeamType(), $teamObj);        return $this->render(':soccer:adminTeam.html.twig', ['team' => $team, 'form' => $form->createView()]);    }    /**     * @Route("/admin/{team}/mod", defaults={"team" = "France"}, name="adm_team_mod")     */    public function teamModAction($team, Request $request)    {    }    /**     * @Route("/admin/{team}/del", defaults={"team" = "France"}, name="adm_team_del")     */    public function teamDelAction($team, Request $request)    {    }    /**     * @Route("/admin/{team}/show.{id}", defaults={"team" = "France"}, name="adm_team_sh_id",     * requirements={"id": "\d+"})     */    public function teamShowAction($team, $id, Request $request)    {    }    /**     * @Route("/admin/{team}/showall", defaults={"team" = "France"}, name="adm_team_sh")     */    public function teamShowAllAction($team, Request $request)    {    }}