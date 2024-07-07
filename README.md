1. **Création du projet Symfony (fait)**:
   ```
   symfony new loc-car-api --version=6.4
   ```
2. **Installation de doctrine symfony/orm-pack (fait)**

```
composer require symfony/orm-pack
```

3. **Installation orm-fixtures (fait)**

```
composer require --dev orm-fixtures
```

4. **Installation du  MakerBundle (fait)** :
   ```
   composer require symfony/maker-bundle --dev
   ```
5.**Installation du  profiler (fait)** :
```
composer require --dev profiler
```

6. **Installer symfony/security-bundle (fait)**

```
composer require symfony/security-bundle
```

7. **Installation API Platform (fait)** :
   ```
   composer require api-platform/core
   ```

8. **Installer Password-hasher Bundle (fait)** : <https://symfony.com/doc/current/security/passwords.html>

```
composer require symfony/password-hasher
```

7. **Installer JWT Authentication Bundle** : <https://api-platform.com/docs/core/jwt/>

   ```bash
   composer require lexik/jwt-authentication-bundle

 ```
 lexik
  
 ```lexik:jwt:check-config ```                    Checks that the bundle is properly configured.  
  ```lexik:jwt:generate-keypair ```                Generate public/private keys for use in your application.
  ```lexik:jwt:generate-token```                   Generates a JWT token for a given user.









composer require symfony/twig-bundle

7. **Installer JWT Authentication Bundle** : <https://api-platform.com/docs/core/jwt/>

   ```bash
   composer require lexik/jwt-authentication-bundle 2.19

 ```
 lexik
  
 ```lexik:jwt:check-config ```                    Checks that the bundle is properly configured.  
  ```lexik:jwt:generate-keypair ```                Generate public/private keys for use in your application.
  ```lexik:jwt:generate-token```                   Generates a JWT token for a given user.





## 2
5. **Créer la base de données** :
   ```bash
   symfony console doctrine:database:create
   ```

6. **Créer une entité User** :

   ```bash
   symfony console make:user
   ```

7. **Générer une migration** :

   ```bash
   symfony console make:migration
   ```

8.**Pour appliquer les migrations:

```bash
symfony console doctrine:migrations:migrate
```

9.** Pour hasher le mot de passge du 1ère admin

```bash
symfony console security:hash-password 
```

security: 'is_granted("ROLE_USER")'
