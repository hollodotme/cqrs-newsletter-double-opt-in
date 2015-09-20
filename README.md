# CQRS newsletter double opt-in

Example for a newsletter double opt-in implementation using CQRS

## The default newsletter double opt-in subscription process

1. The `user` initializes a subscripton by entering his e-mail address in a form an submitting the form.
2. The `application` checks the e-mail address for validity, an existing subscription and its activation status. 
     1. If the e-mail address is valid and does not exists, the `application` will send a confirmation e-mail to the `user`.
     2. If the e-mail address is invalid, the `application` will respond with an error message to the `user`.
     3. If the e-mail address already exists and its activation status is "not confirmed", the `application` will respond with a hint message to the `user` and will provide a way to resend the confirmation e-mail to the `user`.
     4. If the e-mail address already exists and its activation status is "confirmed", the `application` will respond with a hint message to the `user`.
3. The `user` klicks the confirmation link from the confirmation e-mail the `application` sent.
4. The `application` will update the subscription status from "not confirmed" to "confirmed" and send a welcome e-mail to the `user`.

## User Interface

What the `application` needs to present to the `user`:

1. Show a subscription form
2. Depending on the validity and the existence/subsciption status of the e-mail address:
    1. Send a confirmation e-mail to the `user` and show a "Thank you, subscription initialized" page.
    2. Show the subscription form again with an error message.
    3. Show the subscription form again with a hint message and a button to resend the cofirmation e-mail.
    4. Show the subscription form again with a hint message.
3. Show a confirmation form.
4. Show a "Thank you, subscription complete" page.

## Domain actions

Due to the cirumstances we will call the domain "newsletter". :)

Let's break the user interfaces down to GET and POST requests:

1. `GET`: /newsletter/show-subscription-form
2. `POST`: /newsletter/initialize-subscription
    1. `GET`: /newsletter/show-subscription-initialized
    2. `GET`: /newsletter/show-subscription-form
    3. `GET`: /newsletter/show-subscription-form  
    (maybe followed by a `POST`: /newsletter/resend-confirmation-email and a `GET`: /newsletter/show-subscription-initialized)
    4. `GET`: /newsletter/show-subscription-form
3. `GET`: /newsletter/show-confirmation-form
4. `POST`: /newsletter/confirm-subscription
5. `GET`: /newsletter/show-subscription-completed

## Service interfaces

Assuming `SubscriptionId` is a simple value object representing a unique ID and `Subscription` is a simple DTO with the following interface:

```php
<?php

interface SubscriptionInterface
{
    public function getSubscriptionId();
    
    public function getEmail();
    
    public function getStatus();
}
```

### NewsletterReadService

```php
<?php

interface NewsletterReadServiceInterface
{
    /**
     * @param SubscriptionId $subscriptionId
     *
     * @throws SubscriptionNotFound
     *
     * @return Subscription
     */
    public function findSubscriptionById( SubscriptionId $subscriptionId );
    
    /**
     * @param string $email
     *
     * @throws SubscriptionNotFound
     *
     * @return Subscription
     */
    public function findSubscriptionByEmail( $email );
}
```

### NewsletterWriteService

```php
<?php

interface NewsletterWriteServiceInterface
{
    /**
     * @param string $email
     *
     * @throws EmailAddressIsNotValid
     * @throws SubscriptionAlreadyInitialized
     * @throws SubscriptionAlreadyConfirmed
     *
     * @return SubscriptionId
     */
    public function initializeSubscription( $email );
    
    /**
     * @param SubscriptionId $subscriptionId
     *
     * @throws SubscriptionNotFound
     * @throws SubscriptionAlreadyConfirmed
     */
    public function resendConfirmationMail( SubscriptionId $subscriptionId );
    
    /**
     * @param SubscriptionId $subscriptionId
     *
     * @throws SubscriptionNotFound
     * @throws SubscriptionAlreadyConfirmed
     */
    public function confirmSubscription( SubscriptionId $subscriptionId );
}
```
