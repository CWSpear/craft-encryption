<?php 
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class EndecryptTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'Endecrypt';
    }

    /**
     * Set up a map of filter name to functions in this class.
     * 
     * @return array
     */
    public function getFilters()
    {
        return array(
            'encrypt' => new Twig_Filter_Method($this, 'encrypt'),
            'decrypt' => new Twig_Filter_Method($this, 'decrypt'),
        );
    }

    /**
     * Take a string and encrypt it, returning the encrypted hash.
     * 
     * @param  String $str String to be encrypted
     * @return String      Encrypted hash
     */
    public function encrypt($str)
    {
        return craft()->endecrypt->encrypt($str);
    }

    /**
     * Take an encrypted hash and decrypt it, returning the decrypted string.
     * 
     * @param  String $hash Hash to be decrypted (which was encrypted by this service's encrypt method)
     * @return String       Decrypted string
     */
    public function decrypt($hash)
    {
        return craft()->endecrypt->decrypt($hash);
    }
}
