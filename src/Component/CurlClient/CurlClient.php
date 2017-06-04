<?php

namespace Drupal\aa\Component\CurlClient;

class CurlClient
{
    private $ch;
    private $options = [];
    private $headers = [];

    public function __construct(array $options = [], array $headers = [])
    {
        $this->ch = curl_init();

        if(!empty($options)) {
            $this->setOptions();
        }

        if(!empty($headers)) {
            $this->setHeaders($headers);
        }

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLINFO_HEADER_OUT, true);
    }

    public function execute()
    {
        try {
            if(!empty($this->headers)) {
                curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
            }

            $result = curl_exec($this->ch);

            $error = curl_error($this->ch);
            if($error) {
                throw new \Exception($error);
            }

            return $result;
        }
        finally {
            curl_close($this->ch);
        }
    }

    public function setUrl($url)
    {
        $this->addOption(CURLOPT_URL, $url);

        return $this;
    }

    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    public function addOption($curlOption, $value)
    {
        curl_setopt($this->ch, $curlOption, $value);

        return $this;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function addHeader($header)
    {
        $this->headers[] = $header;

        return $this;
    }

    public function setUserAgent($userAgent)
    {
        $this->addOption(CURLOPT_USERAGENT, $userAgent);

        return $this;
    }
}
