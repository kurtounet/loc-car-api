<?php

namespace App\DataFixtures;

use App\Entity\Agence;
use App\Entity\User;
use App\Entity\Vehicl;
use App\Entity\Rental;
use App\Entity\Payment;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // Create Agencies
        $agencies = [];
        for ($i = 0; $i < 10; $i++) {
            $agence = new Agence();
            $agence->setName($faker->company)
                ->setAdress($faker->streetAddress)
                ->setNumAdress($faker->buildingNumber)
                ->setZipcode($faker->postcode)
                ->setCountry('France')
                ->setCity($faker->city)
                ->setPhoneNumber($faker->phoneNumber);
            $manager->persist($agence);
            $agencies[] = $agence;
        }
        echo "Agence created" . "\n";
        // Create Users

        $user = new User();
        $user->setFirstName("Admin")
            ->setLastName('admin')
            ->setEmail('admin@gmail.com')
            ->setPassword('admin')
            ->setphoneNumber('0656575859')
            ->setAdress('rue de la paix')
            ->setNumAdress('100')
            ->setZipcode('69570')
            ->setCountry('France')
            ->setCity('Lyon')
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $users[] = $user;
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            echo $faker->phoneNumber . "\n";
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $user->setFirstName($firstName)
                ->setLastName($lastName)
                ->setEmail($firstName . "." . $lastName . '@' . $faker->randomElement(['gmail.com', 'yahoo.fr', 'hotmail.fr', 'outlook.fr']))
                ->setPassword($lastName)
                ->setphoneNumber($faker->phoneNumber)
                ->setAdress($faker->streetAddress)
                ->setNumAdress($faker->buildingNumber)
                ->setZipcode($faker->postcode)
                ->setCountry('France')
                ->setCity($faker->city)
                ->setRoles(['ROLE_USER'])
            ;

            $manager->persist($user);
            $users[] = $user;
        }
        echo "Users created" . "\n";
        // Create Vehicles
        $vehicles = [];
        for ($i = 0; $i < 50; $i++) {
            $vehicle = new Vehicl();
            $model = [
                'brand' => $faker->randomElement(['Toyota', 'Ford', 'Chevrolet']),
                'model' => $faker->randomElement(['Corolla', 'Mustang', 'Camero']),
                'year' => $faker->year,
            ];
            $vehicle->setBrand($model['brand'])
                ->setModel($model['model'])
                ->setLicensePlate($this->genererPlaqueImmatriculation())
                ->setMileage($faker->numberBetween(10000, 100000))
                ->setFuelType($faker->randomElement(['Essence', 'Diesel', 'Electrique']))
                ->setStatus($faker->randomElement(['disponible', 'indisponible']))
                ->setPricePerDay($faker->numberBetween(50, 300))
                ->setImage($model['brand'] . '-' . $model['model'] . '-' . $model['year'] . '.png')
                ->setDescription($faker->text(100))
                ->setYear($model['year']);
            $manager->persist($vehicle);
            $vehicles[] = $vehicle;
        }

        echo "Vehicles created" . "\n";
        // Create Rentals
        for ($i = 0; $i < 100; $i++) {
            $startDate = $faker->dateTimeThisYear;
            $endDate = $faker->dateTimeInInterval($startDate, '+1 week');
            $rental = new Rental();

            $rental->setClient($faker->randomElement($users))
                ->setVehicle($faker->randomElement($vehicles))
                ->setStartDate($startDate)
                ->setEndDate($endDate)
                ->setTotalPrice($faker->randomFloat(2, 100, 1000))
            ;
            $manager->persist($rental);

            // Link a payment to each rental
            $payment = new Payment();
            $payment->setAmount($rental->getTotalPrice())
                ->setPaymentDate($faker->dateTimeBetween($rental->getStartDate(), $rental->getEndDate()))
                ->setStatus($faker->randomElement(['payer', 'en attente', 'Annuler']))
                ->setPaymentMethod($faker->randomElement(['espece', 'cheque', 'carte']));

            $rental->addPayment($payment);
            $manager->persist($payment);
        }

        echo "Rentals created" . "\n";
        $manager->flush();
    }
    public function genererPlaqueImmatriculation()
    {
        // Liste des lettres et des chiffres possibles
        $lettres = range('A', 'Z');
        $chiffres = range(0, 9);

        // Choisir un pays parmi la France, l'Allemagne, l'Espagne, l'Italie, le Royaume-Uni
        $pays = ['FR', 'DE', 'ES', 'IT', 'UK'];
        $paysChoisi = $pays[array_rand($pays)];

        switch ($paysChoisi) {
            case 'FR':
                // Format français : AA-123-AA
                $partie1 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                $partie2 = $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)];
                $partie3 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                return "$partie1-$partie2-$partie3";

            case 'DE':
                // Format allemand : ABC-DE 1234
                $partie1 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                $partie2 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                $partie3 = $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)];
                return "$partie1-$partie2 $partie3";

            case 'ES':
                // Format espagnol : 1234 ABC
                $partie1 = $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)];
                $partie2 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                return "$partie1 $partie2";

            case 'IT':
                // Format italien : AA 123 AA
                $partie1 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                $partie2 = $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)];
                $partie3 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                return "$partie1 $partie2 $partie3";

            case 'UK':
                // Format britannique : AB12 CDE
                $partie1 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                $partie2 = $chiffres[array_rand($chiffres)] . $chiffres[array_rand($chiffres)];
                $partie3 = $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)] . $lettres[array_rand($lettres)];
                return "$partie1$partie2 $partie3";

            default:
                return "Format non supporté";
        }

    }
}





