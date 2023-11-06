<?php

namespace App\Enum;

enum BookingStatusEnum: string
{
  case PENDING = 'pending';
  case CONFIRMED = 'confirmed';

  public function title(): string
  {
    return match($this)
    {
      self::PENDING => 'Pending',
      self::CONFIRMED => 'Confirmed',
    };
  }
}

?>