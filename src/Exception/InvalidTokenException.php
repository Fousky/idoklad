<?php

namespace Fousky\Component\iDoklad\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * @author Lukáš Brzák <lukas.brzak@aquadigital.cz>
 */
class InvalidTokenException extends \Exception implements iDokladExceptionInterface
{
    /**
     * @param ResponseInterface $response
     * @param int $uniqueCode
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        ResponseInterface $response,
        $uniqueCode,
        $code = 0,
        \Throwable $previous = null
    ) {
        try {
            $message = sprintf(
                '%s: [status_code]: %s, [body]: %s',
                $uniqueCode,
                $response->getStatusCode(),
                $response->getBody()->getContents()
            );
        } catch (\Exception $previous) {
            $message = $uniqueCode;
        }

        parent::__construct($message, $code, $previous);
    }
}
