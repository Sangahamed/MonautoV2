<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidatePrice implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
 public function validate(string $attribute, mixed $value, Closure $fail): void
{
    // Expression régulière pour valider les montants avec ou sans espaces pour les milliers
    $regex = '/^\d{1,3}(?: \d{3})*(?:,\d{2})?$/';

    // Remplace les espaces inutiles pour validation
    $cleanedValue = str_replace(' ', '', $value);

    // Vérifie si la valeur nettoyée correspond à l'expression régulière
    if (!preg_match('/^\d{1,3}(?:\d{3})*(?:,\d{2})?$/', $cleanedValue)) {
        $fail("Le {$attribute} n'est pas valide. Veuillez utiliser un format valide, par exemple 40 000 ou 40 000.");
    }
}


}
