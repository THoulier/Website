<?php
$bdd = mysqli_connect("localhost", "root", "");
$sql = "CREATE DATABASE LGBT";
mysqli_query($bdd, $sql);
mysqli_close($bdd);

$bdd = mysqli_connect("localhost", "root", "","LGBT");


$query = "CREATE TABLE `Utilisateur` (
    `ID` int(11) NOT NULL,
    `Mail` varchar(50) NOT NULL,
    `MdP` varchar(50) NOT NULL,
    `Nom` varchar(50) NOT NULL,
    `Prenom` varchar(50) NOT NULL,
    `Date` date NOT NULL,
    `Pseudo` varchar(50) NOT NULL
  )";

mysqli_query($bdd, $query);

$query = " ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`ID`)";

mysqli_query($bdd, $query);


$query = "  ALTER TABLE `Utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3";

mysqli_query($bdd, $query);
  
$query = "  INSERT INTO `Utilisateur` (`ID`, `Mail`, `MdP`, `Nom`, `Prenom`, `Date`, `Pseudo`) VALUES
(1, 'gabriel.berger98@gmail.com', 'Blabla', 'Berger', 'Gabriel', '1998-04-15', 'Gaby'),
(2, 'tester@gmail.com', 'mdp', 'Tester', 'Gmail', '2000-01-01', 'User')";


mysqli_query($bdd, $query);



$query = "CREATE TABLE `Amis` (
    `ID` int(11) NOT NULL,
    `id_from` int(11) NOT NULL,
    `id_to` int(11) NOT NULL,
    `etat` int(11) NOT NULL
  )";

mysqli_query($bdd, $query);
  
  
$query = "ALTER TABLE `Amis`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_from` (`id_from`),
  ADD KEY `id_to` (`id_to`)";

mysqli_query($bdd, $query);
  
$query = "  ALTER TABLE `Amis`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2";

mysqli_query($bdd, $query);
  
$query = "  INSERT INTO `Amis` (`ID`, `id_from`, `id_to`, `etat`) VALUES
(1, 1, 2, 1)";

mysqli_query($bdd, $query);


$query = "CREATE TABLE `Transactions` (
    `ID` int(11) NOT NULL,
    `Msg_exp` text NOT NULL,
    `User_src` int(11) NOT NULL,
    `User_cible` int(11) NOT NULL,
    `Montant` float NOT NULL,
    `Date_creation` date NOT NULL DEFAULT current_timestamp(),
    `Statut` int(11) NOT NULL DEFAULT 0,
    `Date_fermeture` date DEFAULT NULL,
    `Msg_fer` text DEFAULT NULL
  )";



mysqli_query($bdd, $query);

  
  $query = "  ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_src` (`User_src`),
  ADD KEY `User_cible` (`User_cible`)";

mysqli_query($bdd, $query);

  
  $query = "ALTER TABLE `Transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4";

mysqli_query($bdd, $query);

  
  $query = "INSERT INTO `Transactions` (`ID`, `Msg_exp`, `User_src`, `User_cible`, `Montant`, `Date_creation`, `Statut`, `Date_fermeture`, `Msg_fer`) VALUES
  (1, 'Vacances', 1, 2, 123.5, '2020-05-06', 0, NULL, NULL),
  (2, 'BBQ', 2, 1, 22.33, '2020-04-12', 0, NULL, NULL),
  (3, 'Mcdo', 1, 2, 9.10, '2020-04-23', 0, NULL, NULL),
  (4, 'Courses', 2, 1, 85.30, '2020-03-06', 1, '2020-05-06', 'virement le 12')";

mysqli_query($bdd, $query);



