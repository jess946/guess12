<?php

namespace App\Tests\Core;

use App\Core\Card;
use App\Core\CardGame32;
use CardTTest;
use PHPUnit\Framework\TestCase;

class CTest extends TestCase
{
   public function test32GetCard()
    {
        $g=new CardGame32([new Card("1", "Carreau")]);
        $this->assertEquals(new Card("1","Carreau"),$g->getCard(0));
    }

    public function testSetCard()
    {
        $g=new CardGame32([new Card("1", "Carreau")]);
        $g->setCard(0,new Card("2","Pique"));
        $this->assertNotEquals(new Card("1","Carreau"),$g->getCard(0));

    }

    public function testFactory32()
    {
        $cards= new CardGame32(array(Card::class));//phase
        $z=$cards->factoryCardGame32();
        $op=new Card("As","Coeur");
        $opp=new Card("8","Pique");
        $oppp=new Card("R","Trefle");
        $this->assertEquals($op,$z->getCard(0));
        $this->assertEquals($opp,$z->getCard(30));//pk k-2
        $this->assertEquals($oppp,$z->getCard(47));
    }


    public function testShuffle0()
    {//todo voir que ils sont tous là'2 ,non *2'1 ,et !='0
        $cards= new CardGame32(array(Card::class));
        $z1=$cards->factoryCardGame32();
        $z=$cards->shuffle($z1);
        $this->assertNotEquals($z,$z1);
    }





}
