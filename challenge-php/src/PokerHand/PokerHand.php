<?php

namespace PokerHand;

class PokerHand
{
    protected $invalid;
    protected $cards = [];
    protected $kinds = [];

    public function __construct( string $hand )
    {
        $hand = str_replace( [ 'A', 'K', 'Q', 'J' ], [ '14', '13', '12', '11' ] , $hand );
        $cards = explode( ' ', $hand );
        $this->checkInvalid( $cards );

        foreach( $cards as $card )
        {
            $this->cards[] = new Card( $card );
        }

        $this->sortCards();
        $this->sortKinds();
    }

    protected function sortCards()
    {
        usort( $this->cards, function( $a, $b ) {
            return -( $a->getValue() <=> $b->getValue() );
        });
    }

    protected function sortKinds()
    {
        foreach( $this->cards as $cardOne )
        {
            foreach( $this->cards as $cardTwo )
            {
                if( $cardOne->getValue() === $cardTwo->getValue() )
                {
                    $this->kinds[] = $cardOne->getValue();
                }
            }
        }
        $this->kinds = array_unique( $this->kinds );
    }

    protected function checkInvalid( array $cards )
    {
        $this->invalid = false;
        if( count( $cards ) !== count( array_unique( $cards ) ) ) {
            $this->invalid = true;
        }
    }

    protected function isInvalidHand() : bool
    {
        foreach( $this->cards as $card )
        {
            if( $card->getValue() < 2 || $card->getValue() > 14 )
            {
                $this->invalid = true;
            }
        }
        return $this->invalid;
    }

    protected function isRoyalFlush() : bool
    {

      if( ! $this->isStraightFlush() )
      {
          return false;
      }

      if( 14 === $this->cards[0]->getValue() )
      {
          return true;
      }
      return false;
    }

    protected function isStraightFlush() : bool
    {
        return $this->isFlush() && $this->isStraight();
    }

    protected function isFourKind() : bool
    {
        return $this->isFullHouse() && (
            $this->cards[0]->getValue() === $this->cards[3]->getValue() ||
            $this->cards[1]->getValue() === $this->cards[4]->getValue()
        );
    }

    protected function isFullHouse() : bool
    {
        return count( $this->kinds ) === 2;
    }

    protected function isFlush() : bool
    {
        $suit = $this->cards[0]->getSuit();

        foreach( $this->cards as $card )
        {
            if( $card->getSuit() !== $suit )
            {
                return false;
            }
        }
        return true;
    }

    protected function isStraight() : bool
    {
        for( $i = 1; $i < count( $this->cards ); $i++ )
        {
            if(
                $this->cards[$i-1]->getValue() !==
                ( $this->cards[$i]->getValue() + 1 )
            )
            {
                return false;
            }
        }
        return true;
    }

    protected function isThreeKind() : bool
    {
        return $this->isTwoPair() && (
            $this->cards[0]->getValue() === $this->cards[2]->getValue() ||
            $this->cards[1]->getValue() === $this->cards[3]->getValue() ||
            $this->cards[2]->getValue() === $this->cards[4]->getValue()
        );
    }

    protected function isTwoPair() : bool
    {
        return count( $this->kinds ) === 3;
    }

    protected function isOnePair() : bool
    {
        return count( $this->kinds ) === 4;
    }

    public function getRank() : string
    {
        if( $this->isInvalidHand() )
        {
            return 'Invalid Hand';
        }

        if( $this->isRoyalFlush() )
        {
            return 'Royal Flush';
        }

        if( $this->isStraightFlush() )
        {
            return 'Straight Flush';
        }

        if( $this->isFourKind() )
        {
            return 'Four of a Kind';
        }

        if( $this->isFullHouse() )
        {
            return 'Full House';
        }

        if( $this->isFlush() )
        {
            return 'Flush';
        }

        if( $this->isStraight() )
        {
            return 'Straight';
        }

        if( $this->isThreeKind() )
        {
            return 'Three of a Kind';
        }

        if( $this->isTwoPair() )
        {
            return 'Two Pair';
        }

        if( $this->isOnePair() )
        {
            return 'One Pair';
        }

        return 'High Card';
    }
}
