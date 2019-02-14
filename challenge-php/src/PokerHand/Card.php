<?php

namespace PokerHand;

class Card
{
  protected $value;
  protected $suit;

  public function __construct( string $card )
  {
    $this->value = intval( substr( $card, 0, -1 ) );
    $this->suit  = substr( $card, -1 );
  }

  public function getValue() : int
  {
    return $this->value;
  }

  public function getSuit() : string
  {
    return $this->suit;
  }
}
