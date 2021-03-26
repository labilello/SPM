<?php

namespace App\Http\Traits;


trait SweetAlertLive {
    protected $config = [];
    protected $defaultTimer;

    protected $defaultButtonConfig = [
        'text' => '',
        'visible' => false,
        'value' => null,
        'className' => '',
        'closeModal' => true,
        'toast' => false,
        'allowOutsideClick',
        'showConfirmButton',
        'showCancelButton',
        'confirmButtonText',
        'showCloseButton' => true,


    ];

    /**
     * Create a new SweetAlertNotifier instance.
     *
     *
     */
    public function crearAlerta()
    {
        $this->setDefaultConfig();
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
            'buttons' => [
                'cancel' => false,
                'confirm' => false,
            ],
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


    /**
     * Display an alert message with a text and an optional title.
     *
     * By default the alert is not typed.
     *
     * @param string $text
     * @param string $title
     * @param string $icon
     *
     *
     */
    public function message($text = '', $title = null, $icon = null)
    {
        $this->config['text'] = $text;

        if (! is_null($title)) {
            $this->config['title'] = $title;
        }

        if (! is_null($icon)) {
            $this->config['icon'] = $icon;
        }

        return $this;
    }

    /**
     * Set the duration for this alert until it autocloses.
     *
     * @param int $milliseconds
     *
     *
     */
    public function autoclose($milliseconds = null)
    {
        if (! is_null($milliseconds)) {
            $this->config['timer'] = $milliseconds;
            $this->config['timerProgressBar'] = true;
        }

        return $this;
    }

    /**
     * Add a confirmation button to the alert.
     *
     * @param string $buttonText
     *
     *
     */
    public function confirmButton($buttonText = 'OK', $overrides = [])
    {
        $this->addButton('confirm', $buttonText, $overrides);

        return $this;
    }

    /**
     * Add a cancel button to the alert.
     *
     * @param string $buttonText
     * @param array  $overrides
     *
     *
     */
    public function cancelButton($buttonText = 'Cancel', $overrides = [])
    {
        $this->addButton('cancel', $buttonText, $overrides);

        return $this;
    }

    /**
     * Add a new custom button to the alert.
     *
     * @param string $key
     * @param string $buttonText
     * @param array  $overrides
     *
     *
     */
    public function addButton($key, $buttonText, $overrides = [])
    {
        $this->config['buttons'][$key] = array_merge(
            $this->defaultButtonConfig,
            [
                'text' => $buttonText,
                'visible' => true,
            ],
            $overrides
        );

        $this->closeOnClickOutside(false);
        $this->removeTimer();

        return $this;
    }

    /**
     * Toggle close the alert message when clicking outside.
     *
     * @param string $buttonText
     *
     *
     */
    public function closeOnClickOutside($value = true)
    {
        $this->config['closeOnClickOutside'] = $value;

        return $this;
    }

    /**
     * Make this alert persistent with a confirmation button.
     *
     * @param string $buttonText
     *
     *
     */
    public function persistent($buttonText = 'OK')
    {
        $this->addButton('confirm', $buttonText);
        $this->closeOnClickOutside(false);
        $this->removeTimer();

        return $this;
    }

    /**
     * Remove the timer config option.
     *
     * @return void
     */
    protected function removeTimer()
    {
        if (array_key_exists('timer', $this->config)) {
            unset($this->config['timer']);
            unset($this->config['timerProgressBar']);
        }
    }

    public function getDataToDispatch() {
        $this->dispatchBrowserEvent('swal:modal', $this->config);
        $this->dispatchBrowserEvent('sound:error');
    }


}
