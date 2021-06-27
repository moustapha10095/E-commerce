<?php

namespace App\Controller\Cart;

use App\Form\CheckoutType;
use App\Services\CartServices;
use App\Services\OrderServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CheckoutController extends AbstractController
{
    private $cartServices;
    private $session;

    public function __construct(CartServices $cartServices, SessionInterface $session)
    {
        $this->cartServices = $cartServices;
        $this->session = $session;
    }
    /**
     * @Route("/checkout", name="checkout")
     */
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $cart = $this->cartServices->getFullCart();

        if(!isset($cart['products'])){
            return $this->redirectToRoute("home");
        }

        if(!$user->getAddresses()->getValues()){
            $this->addFlash('checkout_message', 'Please add an address to your account without continuing !');
            return $this->redirectToRoute("address_new");
        }

        if($this->session->get('checkout_data')){
            return $this->redirectToRoute('checkout_confirm');
        }

        $form = $this->createForm(CheckoutType::class,null,['user'=>$user]);


        return $this->render('checkout/index.html.twig',[
            'cart'=> $cart,
            'checkout' => $form->createView()
        ]);
    }

    /**
     * @Route("/checkout/confirm", name="checkout_confirm")
     */
    public function confirm(Request $request, OrderServices $orderServices): Response{
        $user = $this->getUser();
        $cart = $this->cartServices->getFullCart();

        if(!isset($cart['products'])){
            return $this->redirectToRoute("home");
        }

        if(!$user->getAddresses()->getValues()){
            $this->addFlash('checkout_message', 'Please add an address to your account without continuing !');
            return $this->redirectToRoute("address_new");
        }

        $form = $this->createForm(CheckoutType::class,null,['user'=>$user]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() || $this->session->get('checkout_data')){

            if($this->session->get('checkout_data')){
                $data = $this->session->get('checkout_data');
            }else{
                $data = $form->getData();
                $this->session->set('checkout_data',$data);
            }
           
            $address = $data['address'];
            $carrier = $data['carrier'];
            $information = $data["informations"];

            // Save Cart
            $cart['checkout'] = $data;
            $reference = $orderServices->saveCart($cart,$user);
            
            
            

            return $this->render('checkout/confirm.html.twig',[
                'cart'=> $cart,
                'address' => $address,
                'carrier' => $carrier,
                'informations' => $information,
                'reference' => $reference,
                'checkout' => $form->createView()
            ]);
        }
        
        return $this->redirectToRoute('checkout');

    }

    /**
     * @Route("/checkout/edit", name="checkout_edit")
     */
    public function checkoutEdit():Response{
        $this->session->set('checkout_data',[]);
        return $this->redirectToRoute("checkout");
    }

      
}
