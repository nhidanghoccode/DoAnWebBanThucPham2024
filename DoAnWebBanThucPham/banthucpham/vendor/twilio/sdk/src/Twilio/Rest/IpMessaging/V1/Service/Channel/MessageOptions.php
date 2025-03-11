<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Ip_messaging
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\IpMessaging\V1\Service\Channel;

use Twilio\Options;
use Twilio\Values;

abstract class MessageOptions
{
    /**
     * @param string $from 
     * @param string $attributes 
     * @return CreateMessageOptions Options builder
     */
    public static function create(
        
        string $from = Values::NONE,
        string $attributes = Values::NONE

    ): CreateMessageOptions
    {
        return new CreateMessageOptions(
            $from,
            $attributes
        );
    }



    /**
     * @param string $order 
     * @return ReadMessageOptions Options builder
     */
    public static function read(
        
        string $order = Values::NONE

    ): ReadMessageOptions
    {
        return new ReadMessageOptions(
            $order
        );
    }

    /**
     * @param string $body 
     * @param string $attributes 
     * @return UpdateMessageOptions Options builder
     */
    public static function update(
        
        string $body = Values::NONE,
        string $attributes = Values::NONE

    ): UpdateMessageOptions
    {
        return new UpdateMessageOptions(
            $body,
            $attributes
        );
    }

}

class CreateMessageOptions extends Options
    {
    /**
     * @param string $from 
     * @param string $attributes 
     */
    public function __construct(
        
        string $from = Values::NONE,
        string $attributes = Values::NONE

    ) {
        $this->options['from'] = $from;
        $this->options['attributes'] = $attributes;
    }

    /**
     * 
     *
     * @param string $from 
     * @return $this Fluent Builder
     */
    public function setFrom(string $from): self
    {
        $this->options['from'] = $from;
        return $this;
    }

    /**
     * 
     *
     * @param string $attributes 
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes): self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.IpMessaging.V1.CreateMessageOptions ' . $options . ']';
    }
}



class ReadMessageOptions extends Options
    {
    /**
     * @param string $order 
     */
    public function __construct(
        
        string $order = Values::NONE

    ) {
        $this->options['order'] = $order;
    }

    /**
     * 
     *
     * @param string $order 
     * @return $this Fluent Builder
     */
    public function setOrder(string $order): self
    {
        $this->options['order'] = $order;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.IpMessaging.V1.ReadMessageOptions ' . $options . ']';
    }
}

class UpdateMessageOptions extends Options
    {
    /**
     * @param string $body 
     * @param string $attributes 
     */
    public function __construct(
        
        string $body = Values::NONE,
        string $attributes = Values::NONE

    ) {
        $this->options['body'] = $body;
        $this->options['attributes'] = $attributes;
    }

    /**
     * 
     *
     * @param string $body 
     * @return $this Fluent Builder
     */
    public function setBody(string $body): self
    {
        $this->options['body'] = $body;
        return $this;
    }

    /**
     * 
     *
     * @param string $attributes 
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes): self
    {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.IpMessaging.V1.UpdateMessageOptions ' . $options . ']';
    }
}

