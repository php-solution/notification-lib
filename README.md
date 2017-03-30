# Notification component
Notification component helps developer to create functionality for send notification system.

## Concept
### Parts of logic:
* Context
* Manager
* Extension
* Type
* Rule
* Notifier

### Main Flow:
1) Client create Context and set some parameter for notification, specify Type of notification(string name or object) and send this info to Manager
````
$type = new NotificationType();
$context = new Context(['parameter' => 'parameter value']);
$notificationManager->notifyType($type, $context);
````
or
````
$context = new Context(['parameter' => 'parameter value']);
$notificationManager->notifyType(NotificationType::getName(), $context);
````
2) Manager prepare Type and Context via Extension(if Extension is specified for Manager)
3) Type build Rule/Rules(some simple info for Notifier)
4) Notifier accept Rule(parameters) and send real notification.
For example: Email Notifier accept parameters(Rule) for email sending(from, to, cc,text) and send via smtp mail

### Manager
This is a service for send notification, has 2 public methods for send notification: 
* notify(string $name, Context $context = null) - will get Type from TypeRegistry
* notifyType(TypeInterface $type, Context $context = null) - use accepted Type

### Extension
Implements functionality for prepare Type, Context info before build Rules

### Context
Some value object of parameters for Type 

### Type
Rule builder

### Rule
Some value object of parameters for Notifier 

### Notifier
Implements functionality for real notification sending 

## Installing
1. Add to your composer.json
```
    "require": {
        ...
        "php-solution/notification": "dev-master",
        ...
    }    
```

2) run: 
```
    composer update php-solution/notification
```


## Examples:
* basic usage: [link](/examples/basic_usage.php)
* use Symfony context configurator extension, for resolve context parameters [link](/examples/sf_context_configurator.php)
* use Symfony Event dispatcher extension [link](/examples/sf_event_dispatcher.php)