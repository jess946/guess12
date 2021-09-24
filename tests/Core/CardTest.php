<?php

namespace App\Tests\Core;

use App\Core\CardGame32;
use PHPUnit\Framework\TestCase;
use App\Core\Card;

class CardTest extends TestCase
{

  public function testName()
  {
    $card = new Card('As', 'Trèfle');
    $this->assertEquals('As', $card->getName());
    $card = new Card('2', 'Trèfle');
    $this->assertEquals('2', $card->getName());

  }

  public function testColor()
  {
    $card = new Card('As', 'Trèfle');
    $this->assertEquals('Trèfle', $card->getColor());
    $card = new Card('As', 'Pique');
    $this->assertEquals('Pique', $card->getColor());
  }

  public function testCompareSameCard()
  {
    $card1 = new Card('As', 'Trèfle');
    $card2 = new Card('As', 'Trèfle');
    $this->assertEquals(0, CardGame32::compare($card1,$card2));
  }

  public function testNoSameColorSameName()
  {
      //TODO
      $card1= new Card('3','Pique');
      $card2= new Card('3','Carreau');
      $this->assertEquals(-1, CardGame32::compare($card1,$card2));
  }

  public function testNoSameNameSameColor()
  {
    // TODO
      $card1= new Card('As','Pique');
      $card2= new Card('5','Pique');
      $this->assertEquals(1, CardGame32::compare($card1,$card2));
  }

  public function testNoSameCartCompare()
  {
    // TODO
      $card1 = new Card('9', 'Coeur');
      $card2 = new Card('6', 'Pique');
      $this->assertNotEquals(0, CardGame32::compare($card1,$card2));
  }


  public function testToString()
  {
      //TODO
    // vérifie que la représentation textuelle d'une carte est correcte
      $card1 = new Card('As', 'Trèfle');
      $a1=$card1->getName();
      $a2=$card1->getColor();
      $op="name=$a1\tcolor=$a2";
      //$op="name=As\ncolor=Trèfle";
      $this->assertEquals($op,$card1->__toString());
  }

  public function tin_order(){}

}
