<?php

namespace MyApp\Http;

use MyApp\App\Route;

class Response
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_BAD_REQUEST = 400;
    const HTTP_STATUS_NOT_FOUND = 404;
    const HTTP_STATUS_SERVER_ERROR = 500;
    private array $headers = [];
    private ?string $data = null;
    private  int $statusCode;
    private ?string $template = null;
    private string $reDirect = '';

    /**
     * @return string
     */
    public function getReDirect(): string
    {
        return $this->reDirect;
    }

    /**
     * @param string $reDirect
     */
    public function setReDirect(string $reDirect): void
    {
        $this->reDirect = $reDirect;
    }

    /**
     * @return array
     */
    public function getOption(): array
    {
        return $this->option;
    }

    /**
     * @param array $option
     */
    public function setOption(array $option): void
    {
        $this->option = $option;
    }
    private array $option = [];

    public function view(string $template, array $options = [], int $statusCode = Response::HTTP_STATUS_OK): Response
    {
        $this->statusCode = $statusCode;
        $this->template = $template;
        $this->setOption($options);

        return $this;
    }

    public function success(array $data = [], $statusCode = Response::HTTP_STATUS_OK): Response
    {
        $data = [
            'status' => 'success',
            'data' => $data
        ];
        $this->statusCode = $statusCode;
        $this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json'
        ]);
        $this->data = json_encode($data);

        return $this;
    }

    public function error(array $data = [], $statusCode = Response::HTTP_STATUS_BAD_REQUEST): Response
    {
        $data = [
            'status' => 'error',
            'data'=>$data
        ];
        $this->statusCode = $statusCode;
        $this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json'
        ]);
        $this->data = json_encode($data);

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function setTemplate(?string $template): Response
    {
        $this->template = $template;
        return $this;
    }
    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

}
