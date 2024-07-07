# Application de location de véhicules

## 1.Création du projet Symfony +installtion des bundles

1. **Création du projet Symfony (fait)**:

```bash
symfony new loc-car-api --version=6.4
```

2. **Installation de doctrine symfony/orm-pack (fait)**

```bash
composer require symfony/orm-pack
```

3. **Installation orm-fixtures (fait)**

```bash
composer require --dev orm-fixtures
```

3.1 **Installation symfony/asset (fait)**

```bash
composer require symfony/asset
```

4. **Installation du  MakerBundle (fait)** :

```bash
composer require symfony/maker-bundle --dev
```

5. **Installation du  profiler (fait)** :

```bash
composer require --dev profiler
```

6. **Installer symfony/security-bundle (fait)**

```bash
composer require symfony/security-bundle
```

7. **Installation API Platform (fait)** :

```bash
composer require api-platform/core
```

8. **Installer Password-hasher Bundle (fait)** :

><https://symfony.com/doc/current/security/passwords.html>

```bash
composer require symfony/password-hasher
```

9. **Installer JWT Authentication Bundle** : <https://api-platform.com/docs/core/jwt/>

```bash
composer require lexik/jwt-authentication-bundle
 ```

### lexik

##### Checks that the bundle is properly configured

 ```bash
 symfony console lexik:jwt:check-config 
 ```

##### Generate public/private keys for use in your application

  ```bash
symfony console lexik:jwt:generate-keypair 
  ```

##### Generates a JWT token for a given user

  ```bash
  symfony console lexik:jwt:generate-token
  ```

##### Installation de fakerphp/faker

  ```bash
 composer require fakerphp/faker
  ```

## 2. **Création de la base de données**

   ```bash
   symfony console doctrine:database:create
   ```

## 3 Création des entités

#### user + #[ApiResource()] (fait)

```bash
   symfony console make:user
```

#### vehicl + #[ApiResource()] (fait)

```bash
   symfony console make:entity vehicl
```

#### Rental + #[ApiResource()] (fait)

```bash
   symfony console make:entity Rental
```

#### Payment + #[ApiResource()] (fait)

```bash
   symfony console make:entity Payment
```

#### Agency + #[ApiResource()] (fait)

```bash
   symfony console make:entity Agency
```

#### VehicleAgency ManyToMany (a faire)

```bash
   symfony console make:entity VehicleAgency
```

#### Review (à voir)

### 4 **Générer la migration**

   ```bash
   symfony console make:migration
   ```

### 5 **Pour appliquer les migrations**

```bash
symfony console doctrine:migrations:migrate
```

### 6. Création 1er Admin

 Pour hasher le mot de passge du 1ère admin

```bash
symfony console security:hash-password 
```

security: 'is_granted("ROLE_USER")'
