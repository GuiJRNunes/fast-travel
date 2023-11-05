<?php

namespace App\Utilities;

class Unsplash
{
  private static $IMAGE_IDS = [
    'gK1s6P92EIE',
    'TApAkERW5pQ',
    'btQt9i0Krag',
    '-ZYuIWAB0D4',
    '8mJMD0yHBO0',
    'j315d9NRbIs',
    'zunQwMy5B6M',
    'Fn27DlI8bZ8',
    'km74CLco7qs',
    /* 'vk4vjTNVrTg', */
    'K2s_YE031CA',
  ];

  private static $BASE_URL = 'https://source.unsplash.com/';

  public static function generateRandomLink(): string
  {
    return Unsplash::$BASE_URL . Unsplash::$IMAGE_IDS[fake()->randomDigit()];
  }
}