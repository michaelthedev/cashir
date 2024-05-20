<?php

declare(strict_types=1);

namespace App\Services\Gateways;

use App\Interfaces\PaymentGatewayI;
use Illuminate\Support\Arr;

abstract class AbstractGateway implements PaymentGatewayI
{
    protected float $amount;
    protected string $reference;

    protected array $customerParams = ['email', 'name'];
    protected array $customer;

    protected array $response;
    protected string $callback;

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function setCustomer(array $customer): self
    {
        if (!Arr::has($customer, $this->customerParams)) {
            throw new \Exception('Customer data is incomplete');
        }

        $this->customer = $customer;
        return $this;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getMessage(): string
    {
        return $this->response['message'];
    }

    public function isSuccessful(): bool
    {
        return !$this->response['error'];
    }

    public function getData(): array
    {
        return $this->response['data'] ?? [];
    }

    public function setCallback(string $url): self
    {
        $this->callback = $url;
        return $this;
    }

    abstract public function verify(string $reference): array;

    abstract public function checkout(): self;
}
