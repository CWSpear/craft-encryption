# Craft Encryption/Decryption

A set of functions that can be used as a service and in a template (as a Twig filter) to perform 2-way encryption.

## Usage

```html
<input type="hidden" name="email" value="{{ email | encrypt }}">
```

```php
$encryptedEmail = craft()->request->getPost('email');
$email = craft()->endecrypt->decrypt($encryptedEmail);
```

Note that there is both an `encrypt` and `decrypt` that can be used both in the template and as a service.