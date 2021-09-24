<?php

namespace App\Core;

use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class Guess : la logique du jeu.
 * @package App\Core
 */
class Guess
{
  /**
   * @var CardGame32 un jeu de cartes
   */
  private $cardGame;

  /**
   * @var Card c'est la carte à deviner par le joueur
   */
  private $selectedCard;

  /**
   * @var bool pour prendre en compte lors d'une partie
   */
  private $withHelp;

    /**
     * Guess constructor.
     * @param CardGame32|null $cardGame
     * @param Card|null $selectedCard
     * @param bool $withHelp
     */
  public function __construct(CardGame32 $cardGame=null, Card $selectedCard = null, bool $withHelp = true)
  {
      if($cardGame!=null)
          $this->cardGame = $cardGame;
      else
          $this->cardGame=(new CardGame32(array(Card::class)))::factoryCardGame32();
      if($selectedCard!=null)
          $this->selectedCard = $selectedCard;
      else
          $this->selectedCard=rand(0,47);
      $this->withHelp = $withHelp;
  }

    /**
     * @param Card $card
     * @return String
     */
  public function getWithHelp(Card $card):String
  {
      $tes= CardGame32::compare($card,$this->selectedCard);
    if($tes>0)
        return "\nc plus!";
    elseif($tes<0)
        return "\nc moins";
    else
        return "!!";

  }

  /**
   * @param Card $card une soumission du joueur
   * @return bool true si la carte proposée est la bonne, false sinon
   */
  public function isMatch(Card $card): bool
  {
    return CardGame32::compare($card, $this->selectedCard) === 0;
  }

    /**
     * @return Card
     */
    public function getSelectedCard(): Card
    {
        return $this->selectedCard;
    }

    /**
     * @return bool
     */
    public function getWith(): bool
    {
        return $this->withHelp;
    }

    /**
     * @param bool $withHelp
     */
    public function setWithHelp(bool $withHelp): void
    {
        $this->withHelp = $withHelp;
    }





}

