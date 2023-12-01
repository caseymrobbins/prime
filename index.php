<?php

function isPrime($number) {
    if ($number <= 1) {
        return false;
    }

    if ($number == 2 || $number == 3) {
        return true;
    }

    if ($number % 2 == 0 || $number % 3 == 0) {
        return false;
    }

    // Skip divisors of 5
    for ($i = 5; $i * $i <= $number; $i += 6) {
        if ($number % $i == 0 || $number % ($i + 2) == 0) {
            return false;
        }
    }

    return true;
}

function findNextPrime($number) {
    $nextNumber = $number + 1;

    // Ensure the next number is of the form 6k ± 1
    $nextNumber = ($nextNumber % 6 == 0) ? $nextNumber + 1 : $nextNumber;
    
    while (true) {
        if (isPrime($nextNumber)) {
            return $nextNumber;
        }
        $nextNumber += 2;
    }
}


function findPreviousPrime($number) {
    $previousNumber = $number - 1;

    // Ensure the previous number is of the form 6k ± 1
    $previousNumber = ($previousNumber % 6 == 0) ? $previousNumber - 1 : $previousNumber;
    
    while ($previousNumber >= 2) {
        if (isPrime($previousNumber)) {
            return $previousNumber;
        }
        $previousNumber -= 2;
    }

    return "No previous prime found";
}

// Example usage
$givenNumber = 17; // Replace this with your own number
if (isPrime($givenNumber)) {
    echo "$givenNumber is a prime number.";
} else {
    $nextPrime = findNextPrime($givenNumber);
    $previousPrime = findPreviousPrime($givenNumber);

    echo "$givenNumber is not a prime number.\n";
    echo "Next prime: $nextPrime\n";
    echo "Previous prime: $previousPrime\n";
}

?>
