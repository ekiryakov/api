<?php

namespace App\Service;

use App\DTO\LiqpayDTO;
use InvalidArgumentException;
use LiqPay;
use Symfony\Component\Routing\RouterInterface;

class LiqpayManager
{
    /** @var LiqPay  */
    private LiqPay $liqpay;

    /** @var string  */
    private string $public_key;

    /** @var RouterInterface  */
    private RouterInterface $router;

    /**
     * @param string $public_key
     * @param string $private_key
     * @param RouterInterface $router
     */
    public function __construct(string $public_key, string $private_key, RouterInterface $router)
    {
        $this->public_key = $public_key;
        $this->liqpay = new LiqPay($public_key, $private_key);
        $this->router = $router;
    }

    /**
     * @param LiqpayDTO $liqpayDTO
     * @return string
     */
    public function link(LiqpayDTO $liqpayDTO): string
    {
        $data = $liqpayDTO->toArray();
        $data['result_url'] = $this->router->generate('subscription_index');
        $data['server_url'] = $this->router->generate('subscription_pay', ['id' => $liqpayDTO->getOrderId()]);

        $params = $this->validate($data);

        return 'https://www.liqpay.ua/api/3/checkout'
            . '?data=' . $this->data($params)
            . '&signature=' . $this->signature($params);
    }

    /**
     * @param array $params
     * @return array
     */
    protected function validate(array $params): array
    {
        $params['public_key'] = $this->public_key;

        if (!isset($params['version'])) {
            throw new InvalidArgumentException('version is null');
        }
        if (!isset($params['action'])) {
            throw new InvalidArgumentException('action is null');
        }
        if (!isset($params['amount'])) {
            throw new InvalidArgumentException('amount is null');
        }
        if (!isset($params['currency'])) {
            throw new InvalidArgumentException('currency is null');
        }
        if (!isset($params['description'])) {
            throw new InvalidArgumentException('description is null');
        }
        if (!isset($params['order_id'])) {
            throw new InvalidArgumentException('order_id is null');
        }

        return $params;
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
}