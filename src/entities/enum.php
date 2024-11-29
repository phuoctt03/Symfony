<?php

namespace App\Enum;

enum Role: string
{
    case Admin = 'admin';
    case User = 'user';
}

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
}

enum PaymentMethod: string
{
    case CreditCard = 'credit_card';
    case PayPal = 'paypal';
    case Cash = 'cash';
}

enum PaymentStatus: string
{
    case Success = 'success';
    case Failed = 'failed';
    case Pending = 'pending';
}

enum RelatedType: string
{
    case Flight = 'flight';
    case Hotel = 'hotel';
    case Activity = 'activity';
    case Combo = 'combo';
}

