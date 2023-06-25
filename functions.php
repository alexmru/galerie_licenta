<?php
function validate($query, $myString) {
    
    // Convertire la minuscule
    $query = strtolower($query);
    $myString = strtolower($myString);

    // Creare array-uri din cuvinte
    $terms = explode(' ', $query);
    $myString = explode(' ', $myString);
    
    // Validare fiecare atom
    foreach ($terms as $term) {
        // Daca termenul este negativ
        if (strpos($term, '-') === 0) {
            $term = substr($term, 1);
            if (in_array($term, $myString)) {
                return false;
            }
        }
        // Daca termenul este pozitiv
        else {
            if (!in_array($term, $myString)) {
                return false;
            }
        }        
    }
    
    // Daca toate testele au trecut, returneaza true
    return true;
}


