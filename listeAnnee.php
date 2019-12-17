<?php
  // Variable qui ajoutera l'attribut selected de la liste déroulante
  $selected = '';
 
  // Parcours du tableau
  echo '<select name="annees">',"\n";
  for($i=1970; $i<=2030; $i++)
  {
    // L'année est-elle l'année courante ?
    if($i == date('Y'))
    {
      $selected = ' selected="selected"';
    }
    // Affichage de la ligne
    echo "\t",'<option value="', $i ,'"', $selected ,'>', $i ,'</option>',"\n";
    // Remise à zéro de $selected
    $selected='';
  }
  echo '</select>',"\n";
?>
<?php
  // Définition du tableau de couleurs
  $arrayCouleurs = array(
 
    '#ff9900' => 'orange',
    '#00ff00' => 'vert',
    '#ff0000' => 'rouge',
    '#ff00ff' => 'violet',
    '#0000ff' => 'bleu',
    '#000000' => 'noir',
    '#ffffff' => 'blanc',
    '#ffff00' => 'jaune'
  );
  // Variable qui ajoutera l'attribut selected de la liste déroulante
  $selected = '';
 
  // Parcours du tableau
  echo '<select name="couleurs">',"n";
  foreach($arrayCouleurs as $valeurHexadecimale => $nomCouleur)
  {
    // Test de la couleur
    if($nomCouleur === 'bleu')
    {
      $selected = ' selected="selected"';
    }
    // Affichage de la ligne
    echo "\t",'<option value="', $valeurHexadecimale ,'"', $selected ,'>', $nomCouleur ,'</option>',"\n";
    // Remise à zéro de $selected
    $selected='';
  }
  echo '</select>',"\n";
?>