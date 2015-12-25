<?php

namespace HandMadeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use HandMadeBundle\Entity\Product;
use HandMadeBundle\Form\ProductType;

/**
 * Product controller.
 *
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities.
     *
     * @Route("/list", name="product_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('HandMadeBundle:Product')->findAll();

        if (!$products) {
            throw $this->createNotFoundException('Unable to find Product.');
        }

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     * @Route("/{id}", name="product_show", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('HandMadeBundle:Product')->find($id);
        return array(
            'product' => $product,
        );
    }

    /**
     * Finds and displays a Product entity.
     *
     * @Route("/new", name="product_new")
     * @Template()
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $form   = $this->createForm(ProductType::class, $product);
        return array(
            'product' => $product,
            'form'=>$form->createView()
        );
    }
}
