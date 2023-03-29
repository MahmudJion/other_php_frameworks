<?php

use Payum\Core\Request\GetHumanStatus;
use Payum\Core\Registry\RegistryInterface;

class PaymentController extends AbstractController
{
    public function checkoutAction(Request $request, RegistryInterface $payum)
    {
        $gateway = $payum->getGateway('paypal_express_checkout');

        $storage = $payum->getStorage('AppBundle\Entity\Payment');

        $payment = $storage->create();
        $payment->setNumber(uniqid());
        $payment->setCurrencyCode('USD');
        $payment->setTotalAmount(123); // 1.23 EUR
        $payment->setDescription('A description');
        $storage->update($payment);

        $captureToken = $payum->getTokenFactory()->createCaptureToken(
            'paypal_express_checkout',
            $payment,
            'payment_done'
        );

        return $this->redirect($captureToken->getTargetUrl());
    }

    public function doneAction(Request $request, RegistryInterface $payum)
    {
        $token = $payum->getHttpRequestVerifier()->verify($request);
        $gateway = $payum->getGateway($token->getGatewayName());

        $gateway->execute($status = new GetHumanStatus($token));
        $payment = $status->getFirstModel();

        if ($status->isCaptured()) {
            // The payment was successful.
        } else {
            // The payment failed or was cancelled.
        }

        return $this->redirectToRoute('homepage');
    }
}
