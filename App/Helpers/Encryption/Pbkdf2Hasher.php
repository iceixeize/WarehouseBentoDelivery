<?php

namespace App\Helpers\Encryption;
use Illuminate\Support\Str;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;


class Pbkdf2Hasher implements HasherContract
{
    /**
     * Gives information about the hash
     *
     * @param string $hashedValue
     * @return void
     */

    const PBKDF2_HASH_BYTES = 21;
    const HASH_LENGTH = 42;

    public function info($hashedValue)
    {
        
        if (substr_count($hashedValue, ":") === 3 && Str::startsWith($hashedValue, config("auth.pbkdf2.algorithm"))) {
            list($algorithm, $iterations, $salt, $hash) = explode(":", $hashedValue);
            $algorithm = explode(":", $algorithm)[1];
            $hash = bin2hex(base64_decode($hash));
            return [
                "algorithm" => $algorithm,
                "iterations" => $iterations,
                "salt" => $salt,
                "hash" => $hash
            ];
        } else {
            return null;
        }
    }

    /**
     * Creates Django compatible hash from password using PBKDF2 hashing algorithms
     *
     * @param string $password
     * @return string $hashedPassword
     */
    public function make($value, array $options = array())
    {
        $newSalt = base64_encode(random_bytes(5));
        // $newSalt = base64_encode(mcrypt_create_iv(self::PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM));

        return config("auth.pbkdf2.algorithm") . ":" . config("auth.pbkdf2.iterations") . ":" . $newSalt . ":" .
            base64_encode(
                hash_pbkdf2(
                    config("auth.pbkdf2.algorithm"), 
                    $value, 
                    $newSalt, 
                    config("auth.pbkdf2.iterations"),
                    self::PBKDF2_HASH_BYTES,
                    true
                )
            );
    }

    /**
     * Checks the value against the given hash for validation
     *
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return void
     */
    public function check($value, $hashedValue, array $options = array())
    {
        if (substr_count($hashedValue, ":") === 3 && Str::startsWith($hashedValue, config("auth.pbkdf2.algorithm"))) {            
            list($algorithm, $iterations, $salt, $hash) = explode(":", $hashedValue);
            $hash = bin2hex(base64_decode($hash));
            // dd([
            //     'base_hash' => base64_decode($hash),
            //     'algorithm' => $algorithm,
            //     'value' => $value,
            //     'salt' => $salt,
            //     'iterations' => $iterations,
            //     'hash1' => $hash1, 
            //     'hash_pbkdf2' => hash_pbkdf2($algorithm, $value, $salt, $iterations, 42),
            //     'hash' => $hash,
            // ]);

            // เพิ่ม length = 42 มา เพราะเอาไว้เทียบกับ hash
            return hash_pbkdf2($algorithm, $value, $salt, $iterations, SELF::HASH_LENGTH) === $hash;
        } else {
            return false;
        }
    }

    /**
     * Determines if the given settings does not match the settings defined in application config, thus value needs to be rehashed
     *
     * @param string $hashedValue
     * @param array $options
     * @return void
     */
    public function needsRehash($hashedValue, array $options = array())
    {
        if (substr_count($hashedValue, ":") === 3 && Str::startsWith($hashedValue, config("auth.pbkdf2.algorithm"))) {
            list($algorithm, $iterations, $salt, $hash) = explode(":", $hashedValue);
            $algorithm = explode("_", $algorithm)[1];
            if (config("auth.pbkdf2.algorithm") != $algorithm) return true;
            if (config("auth.pbkdf2.iterations") != $iterations) return true;
            return false;
        } else {
            return true;
        }
    }
}