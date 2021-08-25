<?php

namespace App\Service;

use App\DTO\LiqpayDTO;
use App\Entity\Subscription;
use LiqPay;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class LiqpayManager implements PaymentManagerInterface
{
    private const COMMISSION = 2.75;

    /** @var LiqPay  */
    private LiqPay $liqpay;

    /** @var string  */
    private string $public_key;

    /** @var string  */
    private string $private_key;

    /** @var RouterInterface  */
    private RouterInterface $router;

    /**
     * @param string $public_key
     * @param string $private_key
     * @param RouterInterface $router
     */
    public function __construct(
        string $public_key,
        string $private_key,
        RouterInterface $router
    ) {
        $this->public_key = $public_key;
        $this->private_key = $private_key;
        $this->liqpay = new LiqPay($public_key, $private_key);
        $this->router = $router;
    }

    /**
     * @inheritDoc
     */
    public function link(Subscription $subscription): string
    {
        $sid = $subscription->getId();

        $dto = new LiqpayDTO($sid,
            Calculator::execute($subscription, self::COMMISSION),
            $this->description($subscription)
        );

        $params = $dto->toArray();

        $params['public_key'] = $this->public_key;
        $params['result_url'] = $this->router->generate(
            'subscription_index', [],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
        $params['server_url'] = $this->router->generate(
            'subscription_pay', ['id' => $sid],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return 'https://www.liqpay.ua/api/3/checkout'
            . '?data=' . $this->data($params)
            . '&signature=' . $this->signature($params);
    }

    /**
     * @inheritDoc
     */
    public function proof(Request $request): bool
    {
        $data = $request->request->get('data');

        $params = $this->liqpay->decode_params($data);
        $signature = $this->liqpay->str_to_sign($this->private_key . $data . $this->private_key);

        return $signature === $request->request->get('signature')
            && in_array($params['status'], ['subscribed', 'wait_accept']);
    }

    /**
     * @param array $params
     * @return string
     */
    protected function data(array $params): string
    {
        return base64_encode(json_encode($params));
    }

    /**
     * @param array $params
     * @return string
     */
    protected function signature(array $params): string
    {
        return $this->liqpay->cnb_signature($params);
    }

    /**
     * @param Subscription $subscription
     * @return string
     */
    protected function description(Subscription $subscription): string
    {
        $description = 'Subscription #' . $subscription->getId() . ':' . PHP_EOL;
        foreach ($subscription->getOffer() as $offer) {
            $description .= "\u{2713}" . $offer->getTitle() . PHP_EOL;
        }

        return $description;
    }
}