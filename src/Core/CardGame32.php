<?php

namespace App\Core;

use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\This;
use function Sodium\add;

/**
 * Class CardGame32 : un jeu de cartes.
 * @package App\Core
 */
class CardGame32
{
  /**
   * @var $cards array a array of Cards
   */
  private $cards;

  /**
   * Guess constructor.
   * @param array $cards
   */
  public function __construct(array $cards)
  {
    $this->cards = $cards;
  }


    /**
     * Brasse le jeu de carte
     * @param CardGame32 $deck
     * @return CardGame32
     */
      public function shuffle(CardGame32 $deck): CardGame32
      {
          $usetab=[0];
          $aleat=42;
          $tab = new CardGame32(array());//on peut juste maitre 'new CardGame32(array())'
          $tab = $tab::factoryCardGame32();
          for ($i=0;$i<50;$i++)
          {
              $this->tesTabAleat($usetab,$aleat);
              $deck->setCard($i,$tab->getCard($aleat));
              $usetab[$i]=$aleat;
              $aleat=rand(0,47);
          }
          return $tab;
      }

    /**
     * Pour le bon fonctionnement de shuffle(). Retourne une valeur aléatoire qui n'est pas déjà utiliser
     * @param $tab
     * @param $aleat
     * @return int
     */
      public static function tesTabAleat($tab,$aleat): int
      {
              foreach ($tab as $value) {
                  if ($aleat == $value)
                      $aleat=rand(0,47);
                  else
                      return $aleat;
              }
          return 0;
      }


  /** définir une relation d'ordre entre instance de Card.
   * à valeur égale (name) c'est l'ordre de la couleur qui prime
   * coeur > carreau > pique > trèfle
   * Attention : si AS de Coeur est plus fort que AS de Trèfle,
   * 2 de Coeur sera cependant plus faible que 3 de Trèfle
   *
   *  Remarque : cette méthode n'est pas de portée d'instance (static)
   *
   * @see https://www.php.net/manual/fr/function.usort.php
   *
   * @param $c1 Card
   * @param $c2 Card
   * @return int
   * <ul>
   *  <li> zéro si $c1 et $c2 sont considérés comme égaux </li>
   *  <li> -1 si $c1 est considéré inférieur à $c2</li>
   * <li> +1 si $c1 est considéré supérieur à $c2</li>
   * </ul>
   *
   */
  public static function compare(Card $c1, Card $c2) : int
  {
      $c1Name = ($c1->getName());
      $c2Name = ($c2->getName());
      $c1Color = ($c1->getColor());
      $c2Color = ($c2->getColor());
      if ($c1Name === $c2Name and $c1Color===$c2Color) {return 0;}
    //  $tN=['As','2','3','5','6','7','8','9','10','V','D','R'];
      $tC=['Coeur','Carreau','Pique','Trefle'];
      for ($i=0;$i>3;$i++){
          if ($c1Color===$tC[$i] ) $c1Color=$i;
          if ($c2Color===$tC[$i] ) $c2Color=$i;
      }
      if ($c1Color===$c2Color)//g zapper l'As
          return (self::conv($c1Name) >self::conv($c2Name)) ? +1 : -1;
      else
          return($c1Color<$c2Color) ? +1 : -1 ;
  }


    /**
     * Permet de simplifier la fonction compare(), convertie les noms des cartes en nombres.
     * @param $c1Name
     * @return int
     *
     */
  private static function conv($c1Name):int{
      //todo simplifie en go dans le compare mais jcp si c mieux?
      switch ($c1Name){
          case 'As': $k=14;break;
          case 'R':$k=13;break;
          case 'V': $k=11;break;
          case 'D':$k=12;break;
          default: $k=(int)$c1Name;
       }
   return $k;
  }


    /**
     * Crée un jeu de 52 carte.
     * @return CardGame32
     */
  public static function factoryCardGame32() : CardGame32 {
    $Game= [];
    $tC=['Coeur','Carreau','Pique','Trefle'];
    $tN=['As','2','3','5','6','7','8','9','10','V','D','R'];
    $i=0;
    foreach ($tC as $color)
    {
        foreach ($tN as $name){
            $Game[$i]=new Card($name,$color);
            $i++;
        }
    }
  return new CardGame32($Game);
  }


    /**
     * Récupère une carte par un index.
     * @param int $index
     * @return Card|null
     */
  public function getCard(int $index=-1) : ?Card {
      if($index>=0 && $index<=50)
          return  $this->cards[$index];
      return null;
  }

    /**
     * Modifie une carte via son index et une valeur
     * @param $index
     * @param Card $val
     */
  public function setCard($index,Card $val) :void
  {
      if($index>=0 && $index<=47)
          $this->cards[$index]=$val;
  }


    /**
     * @return String
     */
  public function _ToString():String
  {
    $string="";
    foreach ($this->cards as $cart){
        $ez=$cart->__toString();
        $string="$string\n$ez";
    }
    return $string."\t".count($this->cards)."\n";
  }

}
