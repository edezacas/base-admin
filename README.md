Digital Ascetic Base User
=======

This library provide basic abstract class to work with User entity.

Also has implemented routes and services to handle login, logout and reset password.

## DigitalAscetic\BaseUserBundle\Entity\AbstractBaseUser 

This is the abstract class that you must extend from.

## Configuration

The security/user system is pluggable and can be configured this way:

First of all create your own User class extending from AbstractBaseUser:

```

namespace App\Entity;


use DigitalAscetic\BaseUserBundle\Entity\AbstractBaseUser;
use Doctrine\ORM\Mapping as ORM;



/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Table(name="test_user")
 * @ORM\Entity()
 */
class User extends AbstractBaseUser
{

}
```

### Reference

#### config/packages/digital_ascetic_base_user.yaml:

| Property        | Description           | Default  |
| ------------- |:-------------:| -----:|
| user_class      | User entity class | required  |
| firewall_name      | Firewall name to apply security checker      |   main |
| user_enabled | Default user enabled behaviour; if enabled is false user can't login until is enabled | false |

Example: 

```yaml
digital_ascetic_base_user:
  user_class: 'App\Entity\User'
  firewall_name: 'main'
  user_enabled: true // User is enabled by default
```
### Routing

#### config/routes.yaml:

You must import all BaseUser routes:

```yaml
asc_base_user:
  resource: "@WeAreBraveBaseAdminBundle/Resources/config/routes/all.xml"
```

or for example if you don't want reset functionality you can only import:

```yaml
asc_base_user:
  resource: "@WeAreBraveBaseAdminBundle/Resources/config/routes/security.xml"
```

### Security

#### config/packages/security.yaml:

> Review [Symfony Security](https://symfony.com/doc/current/security.html) Documentation: Firewall and authentication sections

```yaml
security:
  encoders:
    App\Entity\User:
      algorithm: auto
      
  providers:
    base_user_provider:
      id: DigitalAscetic\BaseUserBundle\Security\UserProvider
```

## Persisting User to Database

To persist user we can simply use DigitalAscetic\BaseUserBundle\Service\UserManagerInterface *updateUser* method, that automatically handle encoding password and enabled behaviour.

### Example

The next code create a testUser entity, and calling *updateUser* method, automatically encode *plainPassword* and store to *password* property. Also depending on *user_enabled* configuration value, set its behaviour.

```php 
$testUser = new BaseUser();
$testUser->setUsername('test');
$testUser->setEmail('test@test.com');
$testUser->setPlainPassword('12345678');
$this->userManager->updateUser($testUser);
```


## Reset Password

You can use our MVC implementation calling to :

* /reset_password
* /reset_password/confirm/{token}

Or use our RepeatPasswordService with a the methods to accomplish this task.

There are two events dispatched:

* BaseUserEvent::USER_RESET_PASSWORD_REQUESTED when user has requested a new reset password; subscribing you can email to user
* BaseUserEvent::USER_RESET_PASSWORD_SUCCESS when user has successfully reset password


## Extends

This bundle is compatible with JMSSerializerBundle, detecting if it's enabled and add AbstractBaseUser serialize
mappings to its configuration.

```
    id:
      groups: [ id ]
      type: integer
    username:
      groups: [ user.default ]
      type: string
    email:
      groups: [ user.default ]
      type: string
    plainPassword:
      groups: [ user.default ]
      type: string
    roles:
      groups: [ user.roles ]
      type: array
```

## Testing

Run test executing:

```
./vendor/bin/simple-phpunit
```
