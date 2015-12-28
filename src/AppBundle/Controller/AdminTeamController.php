<?phpnamespace AppBundle\Controller;use AppBundle\Form\CountrySel;use Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearQueryCacheDoctrineCommand;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;use Symfony\Bundle\FrameworkBundle\Controller\Controller;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\HttpFoundation\Request;use AppBundle\Form\TeamType;use AppBundle\Entity\Team;Class AdminTeamController extends Controller{    /**     * @Route("/admin/{team}/add", defaults={"team" = "France"}, name="adm_team_add")     */    public function teamAddAction($team, Request $request)    {        $teamObj = new Team();        $form = $this->createForm(new TeamType(), $teamObj);        $form->handleRequest($request);        if ($form->isValid()){            $em = $this->getDoctrine()->getManager();            $em->persist($teamObj);            $em->flush();            $team = $team.' add - OK';        }        return $this->render(':soccer:adminTeam.html.twig', ['team' => $team, 'form' => $form->createView()]);    }    /**     * @Route("/admin/{team}/mod", defaults={"team" = "France"}, name="adm_team_mod")     */    public function teamModAction($team, Request $request)    {        $formData = ''; $formString ='';        $teamObj = new Team();        $form = $this->createForm(new CountrySel(), $teamObj);        $form->handleRequest($request);        if ($form->isValid()) {            /* $em = $this->getDoctrine()->getManager();            $em->persist($teamObj);            $em->flush(); */            $formData = $form->getData();            $formString = $form->getData()->getCountry()->getid().' : '.$form->getData()->getCountry()->getCountry();        }        return $this->render('soccer/adminTeamSel.html.twig',['team' => $team, 'formData' => $formData, 'formString' => $formString, 'form' => $form->createView()]);    }    /**     * @Route("/admin/{team}/del", defaults={"team" = "France"}, name="adm_team_del")     */    public function teamDelAction($team, Request $request)    {    }    /**     * @Route("/admin/{team}/show.{id}", defaults={"team" = "France"}, name="adm_team_sh_id",     * requirements={"id": "\d+"})     */    public function teamShowAction($team, $id, Request $request)    {    }    /**     * @Route("/admin/{team}/showall", defaults={"team" = "France"}, name="adm_team_sh")    * @Template()     */    public function admTeamShowAllAction($team, Request $request)    {        //return $this->render('admTe', ['team' => $team]);        return ['team' => $team];    }}