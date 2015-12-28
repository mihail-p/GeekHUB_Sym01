<?phpnamespace AppBundle\Controller;use AppBundle\Entity\Players;use AppBundle\Form\PlayerAddType;use Symfony\Bundle\FrameworkBundle\Controller\Controller;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\Form\Extension\Core\Type\SubmitType;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\HttpFoundation\Request;Class AdminPlayerController extends Controller{    /**     * @Route("/admin/{team}/player/add", defaults={"team" = "Bulgaria"}, name="adm_pl_add")     */    public function playerAddAction($team, Request $request)    {        /* $formData = '';        $formString = ''; */        $playerObj = new Players();        $form = $this->createForm(new PlayerAddType(), $playerObj);        $form->add('save', SubmitType::class);        $form->handleRequest($request);        if ($form->isValid()) {            /* $formData = $form->getData();            $formString = $form->getData(); */            $em = $this->getDoctrine()->getManager();            $em->persist($playerObj);            $em->flush();        }        return $this->render(':soccer:adminPlayer.html.twig', ['team' => $team, /* 'formData' => $formData, 'formString' => $formString,*/ 'form' => $form->createView()]);    }    /**     * @Route("/admin/{team}/player/{id}/mod", defaults={"team" = "Bulgaria"}, name="adm_pl_mod",     *     requirements={"id": "\d+"})     */    public function playerModAction($team, $id, Request $request)    {        /* $formData = '';        $formString = ''; */        $em = $this->getDoctrine()->getManager();        $playerObj = $em->getRepository('AppBundle:Players')->find($id);        $form = $this->createForm(PlayerAddType::class, $playerObj);        $form->add('modify', SubmitType::class);        if ($request->getMethod() == 'POST') {            $form->handleRequest($request);            if ($form->isValid()) {        /*        $formData = $form->getData(); */                $em->flush();            }        }        return $this->render(':soccer:adminPlayer.html.twig', ['team' => $team, /*'formData' => $formData, 'formString' => $formString,*/ 'form' => $form->createView()]);    }    /**     * @Route("/admin/{team}/player/{id}/del", defaults={"team" = "Bulgaria"}, name="adm_pl_del")     *     requirements={"id": "\d+"})     */    public function playerDelAction($team, $id, Request $request)    {        if($id){            $em = $this->getDoctrine()->getManager();            $entity = $em->getRepository('AppBundle:Players')->find($id);            if(!$id){                throw $this->createNotFoundException('Unable to find Player');            }            $em->remove($entity);            $em->flush();        }        return $this->redirect($this->generateUrl('team', ['team' => $team]));    }    /**     * @Route("/admin/{team}/player/show.{id}", defaults={"team" = "Bulgaria"}, name="adm_pl_sh_id",     * requirements={"id": "\d+"})     */    public function playerShowAction($team, $id, Request $request)    {    }    /**     * @Route("/admin/{team}/player/showall", defaults={"team" = "Bulgaria"}, name="adm_pl_sh")     */    public function playerShowAllAction($team, Request $request)    {    }}