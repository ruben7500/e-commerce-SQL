<?php
require 'vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create();

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "projetdatabase"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully\n";

    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Adress (Street, City, PostalCode, Country) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $faker->streetAddress,
            $faker->city,
            $faker->postcode,
            $faker->country
        ]);
    }
    echo "Inserted into Adress\n";

    
    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Userr (IdAdresse, Username, Name, FirstName, Email, Password, PhoneNumber) VALUES (?, ?, ?, ?, ?, AES_ENCRYPT(?, 'encryption_key'), ?)");
        $stmt->execute([
            $faker->numberBetween(1, 10), 
            $faker->userName,
            $faker->lastName,
            $faker->firstName,
            $faker->email,
            $faker->password,
            $faker->phoneNumber
        ]);
    }
    echo "Inserted into Userr\n";

    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Payment (IdUser, CardNumber, Iban) VALUES (?, AES_ENCRYPT(?, 'encryption_key'), AES_ENCRYPT(?, 'encryption_key'))");
        $stmt->execute([
            $faker->numberBetween(1, 10), 
            $faker->creditCardNumber,
            $faker->iban
        ]);
    }
    echo "Inserted into Payment\n";

    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Product (ProductName, ProductPrice, ProductDescription) VALUES (?, ?, ?)");
        $stmt->execute([
            $faker->words(3, true),
            $faker->randomFloat(2, 5, 500), 
            $faker->sentence
        ]);
    }
    echo "Inserted into Product\n";

    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Photos (Type, IdProduct) VALUES (?, ?)");
        $stmt->execute([
            $faker->randomElement(['jpeg', 'png', 'jpg']),
            $faker->numberBetween(1, 10)  
        ]);
    }
    echo "Inserted into Photos\n";

    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Rate (IdProduct, Description, NbStar) VALUES (?, ?, ?)");
        $stmt->execute([
            $faker->numberBetween(1, 10), 
            $faker->sentence,
            $faker->numberBetween(1, 5) 
        ]);
    }
    echo "Inserted into Rate\n";

    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Cart (IdUser, CartStatus) VALUES (?, ?)");
        $stmt->execute([
            $faker->numberBetween(1, 10), 
            $faker->randomElement(['open', 'closed'])
        ]);
    }
    echo "Inserted into Cart\n";

    
    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO ProductsInCart (IdCart, IdProduct, Quantity) VALUES (?, ?, ?)");
        $stmt->execute([
            $faker->numberBetween(1, 10), 
            $faker->numberBetween(1, 10), 
            $faker->numberBetween(1, 20) 
        ]);
    }
    echo "Inserted into ProductsInCart\n";

    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Command (IdCart, Status) VALUES (?, ?)");
        $stmt->execute([
            $faker->numberBetween(1, 10), 
            $faker->randomElement(['processing', 'shipped', 'delivered'])
        ]);
    }
    echo "Inserted into Command\n";

  
    for ($i = 0; $i < 10; $i++) {
        $stmt = $conn->prepare("INSERT INTO Invoice (IdCommand, TotalPrice) VALUES (?, ?)");
        $stmt->execute([
            $faker->numberBetween(1, 10), 
            $faker->randomFloat(2, 20, 2000) 
        ]);
    }
    echo "Inserted into Invoice\n";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
