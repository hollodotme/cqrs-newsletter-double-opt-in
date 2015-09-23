# CQRS newsletter double opt-in

Example for a newsletter double opt-in implementation using CQRS

## This example is runnable!

We provide a vagrant config and a database scheme to run this example.
Just do the following:

* Execute `vagrant up`
* Follow the instruction shown by the provisioner script at the end
* Go to http://pma.cqrs-newsletter.de
* Import file `env/NewsletterDatabase.sql`
* Go to: http://www.cqrs-newsletter.de

## User stories

1. As user I can subscribe with my e-mail address so that I'll receive newsletters.
2. As user I will receive an e-mail after subscription so that I can confirm my e-mail address.
3. As user I can trigger a resend of the confirmation e-mail so that I can confirm my e-mail address.
4. As user I can confirm my e-mail address so that I can complete the subscription.
5. As user I will receive a welcome e-mail so that I am sure the subscription is completed.

## User Interface

What the `application` needs to present to the `user`:

1. Show a subscription form
2. Depending on the validity and the existence/confirmation status of the e-mail address:
    1. E-mail address is valid and not subscribed:  
    Send a confirmation e-mail to the `user` and show a "Subscription initialized" page.
    2. E-Mail address is invalid:  
    Show the subscription form again with an error message.
    3. E-Mail address is subscribed, but not confirmed:
    Show a "Resend e-mail" form with a hint message and a button to resend the cofirmation e-mail.
    4. E-Mail address is subscribed and confirmed:  
    Show the subscription form again with a hint message.
3. Show a confirmation form.
4. Show a "Subscription confirmed" page.

## Domain actions (`read` and `write`)

Due to the cirumstances we will call the domain "newsletter". :)

Let's break the user interfaces down to GET and POST requests:

1. `GET`: /newsletter/show-subscription-form
2. `POST`: /newsletter/initialize-subscription
    1. `GET`: /newsletter/show-subscription-initialized
    2. `GET`: /newsletter/show-subscription-form
    3. `GET`: /newsletter/show-resend-confirmation-form  
    (followed by a `POST`: /newsletter/resend-confirmation-mail and a `GET`: /newsletter/show-subscription-initialized)
    4. `GET`: /newsletter/show-subscription-form
3. `GET`: /newsletter/show-confirmation-form
4. `POST`: /newsletter/confirm-subscription
5. `GET`: /newsletter/show-subscription-confirmed

So we have 3 unique `write` requests and 5 unique `read` requests.

## Concerns

There are 3 main concerns:

1. Writing subscriptions (Init/Confirm or Insert/Update in CRUD language)
2. Reading subscriptions (Find)
3. Sending e-mails to the user

These concerns lead to 3 service classes. Their interfaces could be described as follows:

### NewsletterWriteServiceInterface

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
     * @throws AddingSubscriptionFailed
     *
     * @return SubscriptionInterface
     */
    public function initializeSubscription( $email );
    
    /**
     * @param SubscriptionId $subscriptionId
     *
     * @throws SubscriptionNotFound
     * @throws SubscriptionAlreadyConfirmed
     *
     * @return SubscriptionInterface
     */
    public function confirmSubscription( SubscriptionId $subscriptionId );
}
```

### NewsletterReadServiceInterface

```php
<?php

interface NewsletterReadServiceInterface
{
    /**
     * @param SubscriptionId $subscriptionId
     *
     * @throws SubscriptionNotFound
     *
     * @return SubscriptionInterface
     */
    public function findSubscriptionById( SubscriptionId $subscriptionId );
    
    /**
     * @param string $email
     *
     * @throws SubscriptionNotFound
     *
     * @return SubscriptionInterface
     */
    public function findSubscriptionByEmail( $email );
}
```

### NewsletterMailServiceInterface

```php
<?php

interface NewsletterMailServiceInterface
{
    /**
     * @param SubscriptionInterface $subscription
     *
     * @throws SendingConfirmationMailFailed
     */
    public function sendConfirmationMail( SubscriptionInterface $subscription );
    
    /**
     * @param string $email
     *
     * @throws SubscriptionNotFound
     * @throws SubscriptionAlreadyConfirmed
     * @throws SendingConfirmationMailFailed
     * @throws EmailAddressIsNotValid
     *
     * @return SubscriptionInterface
     */
    public function resendConfirmationMail( $email );
    
    /**
     * @param SubscriptionInterface $subscription
     *
     * @throws SendingWelcomeMailFailed
     */
    public function sendWelcomeMail( SubscriptionInterface $subscription );
}
```
