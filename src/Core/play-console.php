<?php

require '../../vendor/autoload.php';


echo "*** Création d'un jeu de 32 cartes.***\n";
$cardGame = App\Core\CardGame32::factoryCardGame32();
echo " ==== Instanciation du jeu, début de la partie. ==== \n";
$game =  new App\Core\Guess($cardGame, $cardGame->getCard(rand(0,47)), false);
$userMode = readline("mode de jeu : ");
$userMode=45==$userMode;
$game->setWithHelp($userMode);
$in=0; $win=true;
while($in<log(50,2)&&$win){
    $userCardIndex = readline("Entrez une position de carte dans le jeu : ");
    $userCard = $cardGame->getCard($userCardIndex);//récup la carte select
    if ($userCard == null) {
        $userCard = $cardGame->getCard(0);
        echo "comme t as écrit de la merde j t mis la 1er carte\n";
    }
    if ($game->getWith())//si aide
        echo $game->getWithHelp($userCard) . "\n";

    if ($game->isMatch($userCard))//test victoire
        {echo "Bravo ! \n";$win=false;}
    else
        echo "Loupé !\n";
    echo " ==== Fin prématurée de la partie ====\n";
$in++;
}
echo "*** Terminé ***\n";{
    $dire="1P!";
    if ($userMode)
        $in+=3;
    else
        $in--;
    switch ($in){
        case -1: $dire="tu prend un packer de carte, tu le mélange et puis voila"; break;
        case 0 : $dire="tel Goku tu as developer l ultra instinct!"; break;
        case 1 : $dire="BG je te vénère pour cette exploit"; break;
        case 2 : $dire="bien, si t as pas fait mieux c que t pas talentueux"; break;
        case 3 : $dire="bof"; break;
        case 4 : $dire="mdrr t null XD"; break;
        case 5 : $dire="si t arriver là avec de l aide c que t inutile a la society "; break;
        case 6 : $dire="poijoijoijijo,"; break;
    }
    if ($in<6)
        $dire="T tellement une sous merde que le jeu ne peux pas suivre ta connerie";
    return $dire;//g 0 répartie
}