<?php

/**
 *  IRRATIONAL CREDIT CARDS
 *
 *  This script will read in digits for irrationals stored in seperate files and walk
 *  through them looking for well-formed credit card numbers that pass the Luhn check.
 *
 *  The goal: answering the following questions and their variants...
 *  - How many valid-looking credit cards are there in the first {$n} digits of {$irrational_number}?
 *  - Which irrational numbers have more valid-looking credit cards in their first {$n} digits?
 *  Etc.
 *
 *  Why? Because math.
 */

// Spit out all the found credit card numbers?
$show_ccs = false;

// Set up our array of irrationals.
// Files should contain a solid string of numbers with no decimal punctuation or whitespace of any kind.
// E.g. PI = 314159...
$irrs = array();
$irrs['pi']    = file_get_contents('PI');
$irrs['e']     = file_get_contents('E');
$irrs['root2'] = file_get_contents('ROOT2');
$irrs['root3'] = file_get_contents('ROOT3');
$irrs['phi']   = file_get_contents('PHI');
$irrs['gamma'] = file_get_contents('GAMMA');

// Loop through each irrational number
foreach ($irrs as $irr => $digits){

  echo "== " . $irr . " (" . strlen($digits) . " digits) ==\n";

  $ccs = 0;
  $i   = 0;
  $len = strlen($digits);

  while ($i < ($len-14)){

    /**
     *  Credit Card Formats
     *  Just doing on Luhn check on all 16-digit numbers is no fun, because we want credit cards.
     *  CCs have some conventions to them, such as how all Visa cards start with a 4.
     *  Using the table located here:
     *
     *    http://en.wikipedia.org/wiki/Bank_card_number#Issuer_identification_number_.28IIN.29
     *
     *  ...and limiting to cards with a set length that use Luhn for validation we get the
     *  rule set defined below.
     */

    $cc = array();
    // AMEX
    if (in_array(substr($digits, $i, 2), array('34','37'))){
      $cc['type'] = 'AMEX';
      $cc['len']  = 15;
    }
    // Diners Club Carte Blanche
    else if (in_array(substr($digits, $i, 3), array('300','301','302','303','304','305'))){
      $cc['type'] = 'Diners Club Carte Blanche';
      $cc['len']  = 14;
    }
    // Diners Club International
    else if (substr($digits, $i, 2) == '36'){
      $cc['type'] = 'Diners Club International';
      $cc['len']  = 15;
    }
    // Mastercard
    else if (in_array(substr($digits, $i, 2), array('51','52','53','54','55'))){
      $cc['type'] = 'Mastercard';
      $cc['len']  = 16;
    }
    //  Visa
    else if (substr($digits, $i, 1) == 4){
      $cc['type'] = 'Visa';
      $cc['len']  = 16;
    }
    // Discover
    else if (    substr($digits, $i, 2) == '65' 
              || (((int)substr($digits, $i, 3) >= 644) && ((int)substr($digits, $i, 3) <= 649))
              || substr($digits, $i, 4) == '6011'
              || (((int)substr($digits, $i, 6) >= 622126) && ((int)substr($digits, $i, 6) <= 622925))
                 ){
      $cc['type'] = 'Discover';
      $cc['len']  = 16;
    }
    // JCB
    else if ( ((int)substr($digits, $i, 4) >= 3528) && ((int)substr($digits, $i, 4) <= 3589) ){
      $cc['type'] = 'JCB';
      $cc['len']  = 16;
    }

    if ($cc && ($len - $cc['len'] > $i)){
      $candidate = substr($digits, $i, 16);
      if (luhn($candidate)){
        if ($show_ccs)
          echo str_pad($candidate,16) . " [" . $cc['type'] . "]\n";
        $ccs++;
      }
    }

    $i++;

  }

  echo $ccs . " matches.\n\n";

}

function luhn($num) {
  $sum = 0;
  $alt = false;
  for ($i = strlen($num) - 1; $i >= 0; $i--){
    if ($alt){
      $temp = $num[$i];
      $temp *= 2;
      $num[$i] = ($temp > 9) ? $temp = $temp - 9 : $temp;
    }
    $sum += $num[$i];
    $alt = !$alt;
  }
  return $sum % 10 == 0;
}

?>