<?php

namespace App\Tests\Core;

use App\Core\Card;
use App\Core\CardGame32;
use App\Core\Guess;
use phpDocumentor\Reflection\Types\Boolean;
use PHPUnit\Framework\TestCase;

class GuessTest extends TestCase
{//all construe
  public function testDefaultValueWith() {
    $guess = new Guess(CardGame32::factoryCardGame32());
      $this->assertTrue($guess->getWith());
  }

  public function testGetWith()
  {//todo go add le constructeur
      $gess1= new Guess(CardGame32::factoryCardGame32(),new Card("7","Carreau"),false);
      $this->assertNotTrue($gess1->getWith());
  }
  public function testSetWithHelp()
  {
      $gess= new Guess(CardGame32::factoryCardGame32(),new Card("7","Carreau"));
      $gess->setWithHelp(false);
      $this->assertNotTrue($gess->getWith());

  }
  public function testIsMath()
  {
      $gess= new Guess(CardGame32::factoryCardGame32(),new Card("7","Carreau"));
      $g=new Card("7","Carreau");
      $this->assertTrue($gess->isMatch($g));
  }
  public function testGetSelect()
  {
      $gess= new Guess(CardGame32::factoryCardGame32(),new Card("7","Carreau"));
      $g=new Card("7","Carreau");
      $this->assertEquals($g,$gess->getSelectedCard());

  }
  public function testGetWithHelp()
  {
      $gess= new Guess(CardGame32::factoryCardGame32(),new Card("7","Carreau"),false);
      $g=new Card("6","Carreau");
      $this->assertEquals("\nc moins",$gess->getWithHelp($g));

  }



}
