<?php

declare(strict_types=1);

namespace App\Interfaces;

interface PaymentGatewayI
{

    public function setAmount(float $amount): PaymentGatewayI;

    public function setCustomer(array $customer): PaymentGatewayI;

    public function setReference(string $reference): PaymentGatewayI;

    public function setCallback(string $url): PaymentGatewayI;

    public function getData(): array;
    public function getMessage(): string;
    public function getResponse(): array;

    public function isSuccessful(): bool;

    /**
     * For payments that require redirecting
     */
    public function checkout(): PaymentGatewayI;

    /**
     * Verify a payment with provider by reference
     * @param string $reference
     * @return array
     */
    public function verify(string $reference): array;
}
