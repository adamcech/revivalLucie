<?php


class Config {

    /** @var Config $singleton */
    private static $singleton = null;

    /** @var string $adminLogin login to administration */
    public $adminLogin;

    /** @var string $adminPassword password to administration */
    public $adminPassword;

    /** @var string $dbServername db servername */
    public $dbServername;

    /** @var string $dbUsername db restricted user username */
    public $dbUsername;

    /** @var string $dbPassword db restricted user password */
    public $dbPassword;

    /** @var string $dbName db name */
    public $dbName;

    /** @var string $emailOwner address to send email from contact us form */
    public $emailOwner;

    /** @var string $captchaSecretKey secret key for google invisible reCAPTCHAv3 form validation */
    public $captchaSecretKey;

    /** @var string $smtpHost Host server to email */
    public $smtpHost;

    /** @var string $smtpUsername Login to email */
    public $smtpUsername;

    /** @var string $smtpPassword Password to email*/
    public $smtpPassword;

    /**
     * Config constructor.
     * @param string $adminLogin login to administration
     * @param string $adminPassword password to administration
     * @param string $dbServername db servername
     * @param string $dbUsername db restricted user username
     * @param string $dbPassword db restricted user password
     * @param string $dbName db name
     * @param string $captchaSecretKey secret key for google invisible reCAPTCHAv3 form validation
     * @param string $emailOwner address to send email from contact us form
     * @param string $smtpHost Host server to email
     * @param string $smtpUsername Login to email
     * @param string $smtpPassword Password to email
     */
    private function __construct($adminLogin, $adminPassword, $dbServername, $dbUsername, $dbPassword, $dbName, $captchaSecretKey, $emailOwner, $smtpHost, $smtpUsername, $smtpPassword)
    {
        $this->adminLogin = $adminLogin;
        $this->adminPassword = $adminPassword;

        $this->dbServername = $dbServername;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;

        $this->emailOwner = $emailOwner;
        $this->captchaSecretKey = $captchaSecretKey;

        $this->smtpHost = $smtpHost;
        $this->smtpUsername = $smtpUsername;
        $this->smtpPassword = $smtpPassword;
    }

    /**
     * @return Config
     */
    public static function getConfig() {
        if (Config::$singleton == null) {
            /**
             * JSON Config should contain 11 keys with appropriate values:
             * adminLogin, adminPassword
             * dbServername, dbUsername, dbPassword, dbName
             * captchaSecretKey
             *
             * smtpHost, smtpUsername, smtpPassword
             */
            $configFilePath = $_SERVER['DOCUMENT_ROOT']."/php/config.json";

            $file = fopen($configFilePath, "r");
            $json = fread($file, filesize($configFilePath));
            fclose($file);

            $json = json_decode($json);

            Config::$singleton = new Config(
                $json->adminLogin,
                $json->adminPassword,
                $json->dbServername,
                $json->dbUsername,
                $json->dbPassword,
                $json->dbName,
                $json->captchaSecretKey,
                $json->emailOwner,
                $json->smtpHost,
                $json->smtpUsername,
                $json->smtpPassword
            );
        }

        return Config::$singleton;
    }
}
