<?php
namespace Craft;

class EndecryptService extends BaseApplicationComponent
{
    /**
     * A $pepper to make it a little harder to decrypt (unless you know it's this plugin and find the $pepper here...).
     * 
     * @var string
     */
    private static $pepper = 'qfopkeb234egoiewokh5wv49wu8h4983h';

    /**
     * Secure Key used in the encryption.
     * 
     * @var string
     */
    private $secureKey;

    /**
     * IV used in the encryption.
     * 
     * @var string
     */
    private $iv;

    public function __construct()
    {
        $salt = craft()->plugins->getPlugin('endecrypt')->getSettings()->salt;

        if (!$salt) {
            throw new Exception('The required "Salt" field is not set on the plugin\'s settings page.');
        }

        $this->secureKey = hash('sha256', self::$pepper . $salt, true);
        $this->iv = mcrypt_create_iv(32);
    }

    /**
     * Take a string and encrypt it, returning the encrypted hash.
     * 
     * @param  string $str String to be encrypted
     * @return string      Encrypted hash
     */
    public function encrypt($str)
    {
        return base64_encode(mcrypt_encrypt(
            MCRYPT_RIJNDAEL_256,
            $this->secureKey,
            $str,
            MCRYPT_MODE_ECB,
            $this->iv
        ));
    }

    /**
     * Take an encrypted hash and decrypt it, returning the decrypted string.
     * 
     * @param  string $hash Hash to be decrypted (which was encrypted by this service's encrypt method)
     * @return string       Decrypted string
     */
    public function decrypt($hash)
    {
        return trim(mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256,
            $this->secureKey,
            base64_decode($hash),
            MCRYPT_MODE_ECB,
            $this->iv
        ));
    }
}
