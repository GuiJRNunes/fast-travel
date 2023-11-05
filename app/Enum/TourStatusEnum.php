<?php

namespace App\Enum;

enum TourStatusEnum: string
{
  case OPEN = 'open';
  case CLOSED = 'closed';
  case UNDER_MAINTENANCE = 'under_maintenance';

  public static function getSelectOptions(): array
  {
    $result = [];

    foreach(self::cases() as $status) 
    {
      array_push($result, ['value' => $status->value, 'option' => $status->title()]);
    }

    return $result;
  }

  public function title(): string
  {
    return match($this)
    {
      self::OPEN => 'Open',
      self::CLOSED => 'Closed',
      self::UNDER_MAINTENANCE => 'Under maintenance',
    };
  }
}

?>