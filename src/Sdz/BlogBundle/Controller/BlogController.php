<?php
namespace Sdz\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sdz\BlogBundle\Entity\Article;
use Sdz\BlogBundle\Entity\Image;
use Sdz\BlogBundle\Entity\Commentaire;
use Sdz\BlogBundle\Entity\ArticleCompetence;
use Sdz\BlogBundle\Form\ArticleType;
use JMS\SecurityExtraBundle\Annotation\Secure;

class BlogController extends Controller
{
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('SdzBlogBundle:Article');
        
        $nbArticles = $repository->getTotal();
        
        $nbArticlesPage = 5;
        
        $nbPages = ceil($nbArticles/$nbArticlesPage);
        
        $offset = ($page-1) * $nbArticlesPage;
        
        if ($page < 1 OR $page > $nbPages)
        {
            throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
        }
        
        $articles = $repository->findBy(
            array(),                    // pas de critère
            array('date' => 'desc'),    // Tri par date décroissante
            $nbArticlesPage,            // On sélectionne les N articles
            $offset                     // A partir du enième
        );
        // Traitement formulaire
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST') 
        {
            $motcle = '';
            $motcle = $request->request->get('toto');
            
            $em = $this->container->get('doctrine')->getManager();
            if($motcle != '')
            {
                   $qb = $em->createQueryBuilder();
                   $qb->select('a')
                      ->from('SdzBlogBundle:Article', 'a')
                      ->where("a.titre LIKE :motcle OR a.contenu LIKE :motcle")
                      ->orderBy('a.titre', 'ASC')
                      ->setParameter('motcle', '%'.$motcle.'%');
                   $query = $qb->getQuery();               
                   $articles = $query->getResult();
            }
            else {
                $articles = $em->getRepository('SdzBlogBundle:Article')->findAll();
            }
        }
        return $this->render('SdzBlogBundle:Blog:index.html.twig', array(
            'articles' => $articles,
            'page' => $page,
            'nbPages' => $nbPages
        ));
    }
    
    public function voirAction(Article $article)
    {
        return $this->render('SdzBlogBundle:Blog:voir.html.twig', array(
            'article' => $article,
            'tags' => $article->getTags()
        ));
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function ajouterAction()
    {
        $article = new Article();
        $article->setDate(new \Datetime());
        $form = $this->createForm(new ArticleType, $article);
        
        // Traitement formulaire
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                
                foreach($article->getTags() as $tag) {
                    $em->persist($tag);
                    $em->flush();
                }
                
                return $this->redirect($this->generateUrl('sdz_blog_voir', array('slug' => $article->getSlug())));
            }
        }
        
        return $this->render('SdzBlogBundle:Blog:ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function modifierAction(Article $article)
    {
        // Si l'article n'existe pas : erreur 404
        if($article === null) {
            throw $this->createNotFoundException('Article[slug='.$slug.'] inexistant');
        }
        
        $form = $this->createFormBuilder($article)
            ->add('date', 'date')
            ->add('titre', 'text', array(
                    'attr'   =>  array(
                        'class'   => 'form-control')
            ))
            ->add('contenu', 'textarea', array('required' => false))
            ->add('auteur', 'text', array(
                    'attr'   =>  array(
                        'class'   => 'form-control')
            ))
            ->add('publication', 'checkbox', array('required' => false))
            ->add('tags',  null,        array(
                'property' => 'nom',
                'multiple' => true,
                'attr'   =>  array(
                        'class'   => 'form-control')
            ))
            ->getForm();
        
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirect($this->generateUrl('sdz_blog_voir', array('slug' => $article->getSlug())));
            }
        }
        
        return $this->render('SdzBlogBundle:Blog:modifier.html.twig', array(
            'article' => $article,
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function supprimerAction(Article $article)
    {
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'article contre cette faille
        $form = $this->createFormBuilder()->getForm();
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
          $form->bind($request);
          
          if ($form->isValid()) { // Ici, isValid ne vérifie donc que le CSRF
            // On supprime l'article
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
            // On définit un message flash
            $this->get('session')->getFlashBag()->add('info', 'Article bien supprimé');
            // Puis on redirige vers l'accueil
            return $this->redirect($this->generateUrl('sdz_blog_accueil'));
          }
        }
        
        // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('SdzBlogBundle:Blog:supprimer.html.twig', array(
          'article' => $article,
          'form'    => $form->createView()
        ));
    }
    
    public function menuAction()
    {
        $liste = array(
            2 => "Mon dernier weekend !",
            5 => "Sortie de Symfony 2.1",
            9 => "Petit test"
        );
        
        return $this->render('SdzBlogBundle:Blog:menu.html.twig',array(
            'liste_articles' => $liste // toto
        ));
    }

    public function testerAction($toot)
    {
        return $this->render('SdzBlogBundle:Blog:test.html.twig',array(
            'name' => $toot // toto
        ));
    }
}