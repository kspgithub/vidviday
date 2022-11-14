<?php

namespace App\Lib\WayForPay;

use App\Models\PurchaseTransaction;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\MerchantTypes;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Wizard\PurchaseWizard;

abstract class PurchaseAbstract
{
    protected $transactionType = MerchantTypes::TRANSACTION_AUTO;

    protected $order;

    protected $orderDate;

    protected $orderNumber;

    protected $orderReference;

    protected $products = [];

    protected $client;

    protected $returnUrl;

    protected $serviceUrl;

    protected $amount;

    protected $currency;

    protected $domain;

    public function __construct($order)
    {
        $this->domain = config('services.wayforpay.domain');
        $this->order = $order;

        $this->setClient([
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'email' => $order->email,
            'phone' => $order->phone,
            'country' => 'UA',
        ]);

        $amount = config('services.wayforpay.test') ? 1 : $order->total_price;

        $this->products = [
            ['title' => $order->title, 'price' => $amount, 'count' => 1],
        ];
        $this->amount = $amount;
        $this->currency = $order->currency;
        $this->orderDate = ! empty($order->created_at) ? $order->created_at?->toDateTime() : new \DateTime();
        $this->serviceUrl = url(route('purchase.service'));
    }

    public function createNewTransaction()
    {
        $transaction = new PurchaseTransaction();
        $transaction->model_type = $this->order::class;
        $transaction->model_id = $this->order->id;
        $transaction->orderReference = $this->getOrderReference();
        $transaction->amount = $this->getAmount();
        $transaction->currency = $this->getCurrency();
        $transaction->transactionStatus = 'New';
        $transaction->save();
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getOrderDate()
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTime $orderDate)
    {
        $this->orderDate = $orderDate;
    }

    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    public function setOrderNumber($number)
    {
        $this->orderNumber = $number;
    }

    public function getOrderReference()
    {
        return $this->orderReference;
    }

    public function setOrderReference($number)
    {
        $this->orderReference = $number;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    public function setReturnUrl($url)
    {
        $this->returnUrl = $url;
    }

    public function getServiceUrl()
    {
        return $this->serviceUrl;
    }

    public function setServiceUrl($url)
    {
        $this->serviceUrl = $url;
    }

    public function getTransactionType()
    {
        return $this->transactionType;
    }

    public function setTransactionType($type)
    {
        $this->transactionType = $type;
    }

    protected function getCredential()
    {
        return new AccountSecretCredential(config('services.wayforpay.login'), config('services.wayforpay.secret'));
    }

    public function setClient($data)
    {
        $this->client = new Client(
            $data['first_name'],
            $data['last_name'],
            $data['email'] ?? '',
            $data['phone'],
            $data['country'] ?? 'UA',
        );
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setProducts(array $products = [])
    {
        $this->products = $products;
    }

    public function getProductCollection()
    {
        $products = [];
        foreach ($this->products as $product) {
            $products[] = new Product($product['title'], $product['price'], $product['count'] ?? 1);
        }

        return new ProductCollection($products);
    }

    public function getWizard()
    {
        return PurchaseWizard::get($this->getCredential())
            ->setOrderNo($this->getOrderNumber())
            ->setOrderReference($this->getOrderReference())
            ->setAmount($this->getAmount())
            ->setCurrency($this->getCurrency())
            ->setOrderDate($this->getOrderDate())
            ->setMerchantTransactionType($this->getTransactionType())
            ->setMerchantDomainName($this->getDomain())
            ->setClient($this->getClient())
            ->setProducts($this->getProductCollection())
            ->setReturnUrl($this->getReturnUrl())
            ->setServiceUrl($this->getServiceUrl());
    }

    public function getForm()
    {
        return $this->getWizard()->getForm();
    }

    public function getFormAsString()
    {
        return $this->getForm()->getAsString();
    }

    public function getFormAsWidget()
    {
        return $this->getForm()->getWidget();
    }
}
