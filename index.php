<?php

function isPrime($number) {
    if ($number <= 1) {
        return false;
    }

    // Handle base cases for 2 and 3
    if ($number == 2 || $number == 3) {
        return true;
    }

    // Check divisibility by 2 and 3
    if ($number % 2 == 0 || $number % 3 == 0) {
        return false;
    }

    // Skip divisors of 5
    for ($i = 5; $i * $i <= $number; $i += 6) {
        // Check for divisibility by 6k ± 1
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

    // Find the next prime number
    while (true) {
        if (isPrime($nextNumber)) {
            return $nextNumber;
        }
        // Skip even numbers
        $nextNumber += 2; 
    }
}

function findPreviousPrime($number) {
    $previousNumber = $number - 1;

    // Ensure the previous number is of the form 6k ± 1
    $previousNumber = ($previousNumber % 6 == 0) ? $previousNumber - 1 : $previousNumber;

    // Find the previous prime number
    while ($previousNumber >= 2) {
        if (isPrime($previousNumber)) {
            return $previousNumber;
        }
        // Skip even numbers
        $previousNumber -= 2; 
    }

    return "No previous prime found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Checker</title>
</head>
<body>

<h1>Prime Checker</h1>

<form method="post">
    <label for="number">Enter a number:</label>
    <input type="number" name="number" id="number" required>
    <button type="submit">Check</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted
    $givenNumber = isset($_POST['number']) ? intval($_POST['number']) : 0;

    if (isPrime($givenNumber)) {
        echo "<p>$givenNumber is a prime number.</p>";
    } else {
        $nextPrime = findNextPrime($givenNumber);
        $previousPrime = findPreviousPrime($givenNumber);

        echo "<p>$givenNumber is not a prime number.</p>";
        echo "<p>Next prime: $nextPrime</p>";
        echo "<p>Previous prime: $previousPrime</p>";
    }
}
?>

</body>
</html>
