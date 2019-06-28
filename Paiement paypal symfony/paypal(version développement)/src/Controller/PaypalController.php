<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Payment\CoreBundle\Form\ChoosePaymentMethodType;
use Symfony\Component\HttpFoundation\Request;


class PaypalController extends AbstractController
{
    /**
     * @Route("/paypal", name="paypal")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PaypalController.php',
        ]);
    }

    /**
     * @Route("/new/{amount}", name="paye")
     */
    public function newAction( $amount)
    {
        $em = $this->getDoctrine()->getManager();

        $order = new Order($amount);
        $em->persist($order);
        $em->flush();

        return $this->redirectToRoute('app_orders_show', [
            'orderId' => $order->getId(),
        ]);
    }

    /**
     * @Route("/{orderId}/show", name="paye_form")
     */
    /*public function showAction( $orderId, Request $request, PluginController $ppc)
    {
        $order = $this->getDoctrine()->getManager()->getRepository(Order::class)->find($orderId);

        $form = $this->createForm(ChoosePaymentMethodType::class, null, [
            'amount'   => $order->getAmount(),
            'currency' => 'EUR',
        ]);

        return $this->render('Orders/show.html.twig', [
            'order' => $order,
            'form'  => $form->createView(),
        ]);
    }
    */
}
