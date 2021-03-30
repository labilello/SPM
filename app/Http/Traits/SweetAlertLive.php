<?php

namespace App\Http\Traits;


trait SweetAlertLive {
    protected $config = [];
    protected $defaultTimer = 4000;

    protected $defaultButtonConfig = [
        'text' => '',
        'value' => null,
        'className' => '',
        'toast' => false,
        'timer' => false,
        'timerProgressBar' => false,
        'allowOutsideClick' => false,
        'showConfirmButton' => false,
        'showCancelButton' => false,
        'confirmButtonText' => false,
        'showCloseButton' => false,
    ];

    /**
     * Create a new SweetAlertNotifier instance.
     *
     *
     */
    public function crearAlerta($text = '', $title = null, $icon = null)
    {
        $this->setDefaultConfig();
        $this->config['text'] = $text;

        if (! is_null($title))
            $this->config['title'] = $title;

        if (! is_null($icon))
            $this->config['icon'] = $icon;

        return $this;
    }

    /**
     * Sets all default config options for an alert.
     *
     * @return void
     */
    protected function setDefaultConfig()
    {
        $this->setConfig([
            'timer' => $this->defaultTimer,
            'text' => '',
        ]);
    }

    /**
     * Return the current alert configuration.
     *
     * @return array
     */
    public function getConfig($key = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        if (array_key_exists($key, $this->config)) {
            return $this->config[$key];
        }
    }

    /**
     * Customize alert configuration "by hand".
     *
     * @return array
     */
    public function setConfig($config = [])
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    public function addCloseButton($closeButtonHtml = '&times;', $closeButtonAriaLabel = 'Cerrar ventana')
    {
        $this->config['showCloseButton'] = true;
        $this->config['closeButtonHtml'] = $closeButtonHtml;
        $this->config['closeButtonAriaLabel'] = $closeButtonAriaLabel;

        return $this;
    }

    public function addCancelButton($cancelButtonText = 'Cerrar', $cancelButtonColor = '#aaa', $focusCancel = true)
    {
        $this->config['showCancelButton'] = true;
        $this->config['cancelButtonText'] = $cancelButtonText;
        $this->config['cancelButtonColor'] = $cancelButtonColor;
        $this->config['focusCancel'] = $focusCancel;

        return $this;
    }

    /**
     * Toggle close the alert message when clicking outside.
     *
     * @param string $buttonText
     *
     *
     */
    public function allowOutsideClick($value = true)
    {
        $this->config['allowOutsideClick'] = $value;
        return $this;
    }


    public function autoclose($milliseconds = null)
    {
        if (! is_null($milliseconds))
            $this->config['timer'] = $milliseconds;
        else
            $this->config['timer'] = $this->defaultTimer;

        $this->config['timerProgressBar'] = true;
        return $this;
    }

    protected function removeTimer()
    {
        if (array_key_exists('timer', $this->config)) {
            unset($this->config['timer']);
            unset($this->config['timerProgressBar']);
        }

        return $this;
    }

    protected function toast($msAutoClose = null) {
        $this->addCloseButton();
        $this->config['showConfirmButton'] = false;
        $this->config['toast'] = true;
        $this->config['position'] = 'top-end';

        $this->autoclose($msAutoClose);

        return $this;
    }

    public function getDataToDispatch() {
        if( $this->config['icon'] == 'error' || $this->config['icon'] == 'success' )
            $this->dispatchBrowserEvent('sound:play', $this->config['icon']);

        $this->dispatchBrowserEvent('swal:modal', $this->config);
    }


}
