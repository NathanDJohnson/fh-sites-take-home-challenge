<?php
namespace PokerHand;

use PHPUnit\Framework\TestCase;

class PokerHandTest extends TestCase
{
    /**
     * @test
     */
    public function itCanRankARoyalFlush()
    {
        $hand = new PokerHand('As Ks Qs Js 10s');
        $this->assertEquals('Royal Flush', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAStraightFlush()
    {
        $hand = new PokerHand('Ks Qs Js 10s 9s');
        $this->assertEquals('Straight Flush', $hand->getRank());
    }


    /**
     * @test
     */
    public function itCanRankFourKind()
    {
        $hand = new PokerHand('Ks Kh Kd Kc 3h');
        $this->assertEquals('Four of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankFullHouse()
    {
        $hand = new PokerHand('Ks Kh Kd 3c 3h');
        $this->assertEquals('Full House', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAFlush()
    {
        $hand = new PokerHand('Kh Qh 6h 2h 9h');
        $this->assertEquals('Flush', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAStraight()
    {
        $hand = new PokerHand('Ks Qh Jh 10c 9h');
        $this->assertEquals('Straight', $hand->getRank());
    }


    /**
     * @test
     */
    public function itCanRankThreeKind()
    {
        $hand = new PokerHand('Ks Kh Kd 2c 3h');
        $this->assertEquals('Three of a Kind', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankTwoPair()
    {
        $hand = new PokerHand('Kh Kc 3s 3h 2d');
        $this->assertEquals('Two Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankAPair()
    {
        $hand = new PokerHand('Ah As 10c 7d 6s');
        $this->assertEquals('One Pair', $hand->getRank());
    }

    /**
     * @test
     */
    public function itCanRankHighCard()
    {
        $hand = new PokerHand('Ks 10h 6d 2c 3h');
        $this->assertEquals('High Card', $hand->getRank());
    }

}
