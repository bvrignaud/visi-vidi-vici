<?php

declare(strict_types=1);

namespace App\Services\StormGlassApi;

enum ErrorCodes: int
{
    case PaymentRequired = 402;
    case Forbidden = 403;
    case Gone = 410;
    case InternalServerError = 500;

    public function description(): string
    {
        return match ($this) {
            self::PaymentRequired => 'You’ve exceeded the daily request limit for your subscription. Please consider upgrading if this happens frequently.',
            self::Forbidden => 'Your API-key was not provided together with the request or was provided but malformed. Please make sure that you specify your API-key correctly.',
            self::Gone => 'You’ve requested a legacy API resource that is no longer in service. Please review the API documentation.',
            self::InternalServerError => 'We encountered an unexpected problem with our systems. Please try again later.',
        };
    }
}
