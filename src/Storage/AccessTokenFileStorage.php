<?php

namespace Fousky\Component\iDoklad\Storage;

use Symfony\Component\Filesystem\Filesystem;
use Fousky\Component\iDoklad\Exception\TokenNotFoundException;
use Fousky\Component\iDoklad\Model\Auth\AccessToken;

/**
 * @author Lukáš Brzák <lukas.brzak@aquadigital.cz>
 */
class AccessTokenFileStorage implements AccessTokenStorageInterface
{
    /** @var string $file */
    protected $file;

    /** @var AccessToken|null $token */
    protected $token;

    /**
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Has storage token?
     *
     * @return bool
     */
    public function hasToken(): bool
    {
        if ($this->token instanceof AccessToken) {
            return true;
        }

        $this->token = null;

        try {
            $token = unserialize(
                file_get_contents($this->file),
                [
                    'allowed_classes' => AccessToken::class,
                ]
            );

            if ($token instanceof AccessToken) {
                $this->token = $token;
                return true;
            }
        } catch (\Throwable $e) {
            return false;
        }

        return false;
    }

    /**
     * Get AccessToken from Storage or throw TokenNotFoundException if not found.
     *
     * @return AccessToken
     * @throws TokenNotFoundException
     */
    public function getToken(): AccessToken
    {
        if (!$this->hasToken()) {
            throw new TokenNotFoundException();
        }

        return $this->token;
    }

    /**
     * Set AccessToken to the Storage object.
     *
     * @param AccessToken $token
     */
    public function setToken(AccessToken $token)
    {
        file_put_contents(
            $this->file,
            serialize($token)
        );

        $this->token = $token;
    }

    /**
     * Abandon AccessToken.
     *
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function abandonToken()
    {
        (new Filesystem())->remove($this->file);

        $this->token = null;
    }

    /**
     * Is AccessToken expired?
     *
     * @return bool
     */
    public function isTokenExpired(): bool
    {
        try {
            $token = $this->getToken();

            if (!$token instanceof AccessToken) {
                return true;
            }

            return $token->isExpired();

        } catch (\Throwable $e) {
            return true;
        }
    }
}
