<?php
/**
 * ****************************************************
 * @Copyright (c) 2019.
 * @version 1.2 : V-Team.
 * ****************************************************
 * @Class: Retorna dados na máquina que está acessamdo
 *         o servidor.
 * ****************************************************
 * @log v1.2 : Adicionado método para obter o IP da 
 *             máquina.
 * ****************************************************
 **/
defined('BASEPATH') OR exit('Você não tem para acessar esse diretorio ou não existe!!');

class UserAgent {

    private $userData;
    private $userIP;
    private $setOS;
    private $setBrowser;
    private $osTrue = null;
    private $browserTrue = null;

    /** ************************************************
     * @Method: Define os dados e chama os métodos.
     * *************************************************/
    function __construct() {
        $filterServe = filter_input_array(INPUT_SERVER, FILTER_DEFAULT);
        $filterIp = filter_input_array(INPUT_SERVER, FILTER_VALIDATE_IP);
        $this->userData = $filterServe['HTTP_USER_AGENT'];
        $this->userIP = $filterIp['REMOTE_ADDR'];
        $this->checkOs();
        $this->checkBrowser();
    }

    /** ************************************************
     * @Method: Verifica o sistema operacional.
     * *************************************************/
    private function checkOs() {
        $os = [
            '/windows nt 10/i' => 'Windows 10', 
            '/windows nt 6.3/i' => 'Windows 8.1', 
            '/windows nt 6.2/i' => 'Windows 8', 
            '/windows nt 6.1/i' => 'Windows 7', 
            '/windows nt 6.0/i' => 'Windows Vista', 
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', 
            '/windows nt 5.1/i' => 'Windows XP', 
            '/windows xp/i' => 'Windows XP', 
            '/windows nt 5.0/i' => 'Windows 2000', 
            '/windows me/i' => 'Windows ME', 
            '/win98/i' => 'Windows 98', 
            '/win95/i' => 'Windows 95', 
            '/win16/i' => 'Windows 3.11', 
            '/macintosh|mac os x/i' => 'Mac OS X', 
            '/mac_powerpc/i' => 'Mac OS 9', 
            '/linux/i' => 'Linux', 
            '/ubuntu/i' => 'Ubuntu', 
            '/iphone/i' => 'iPhone', 
            '/ipod/i' => 'iPod', 
            '/ipad/i' => 'iPad', 
            '/android/i' => 'Android', 
            '/blackberry/i' => 'BlackBerry', 
            '/webos/i' => 'Mobile'
        ];
        foreach ($os as  $reg => $value) {
            if (preg_match($reg, $this->userData)) {
                $this->setOS = (string) $value;
                $this->osTrue = true;
            }
        }
    }

    /** ************************************************
     * @Method: Verifica o navegador.
     * *************************************************/
    private function checkBrowser() {
        $browser = [
            '/msie/i' => 'Internet Explorer', 
            '/firefox/i' => 'Firefox', 
            '/safari/i' => 'Safari', 
            '/chrome/i' => 'Chrome', 
            '/edge/i' => 'Edge', 
            '/opera/i' => 'Opera', 
            '/netscape/i' => 'Netscape', 
            '/maxthon/i' => 'Maxthon', 
            '/konqueror/i' => 'Konqueror', 
            '/mobile/i' => 'Handheld Browser'
        ];
        foreach ($browser as $reg => $value) {
            if (preg_match($reg, $this->userData)) {
                $this->setBrowser = (string) $value;
                $this->browserTrue = true;
            }
        }
    }

    /** ************************************************
     * @Method: Retorna os dados da máquina que está
     * acessando.
     * *************************************************/
    public function getUserMachine() {
        return $this->userData;
    }

    /** ************************************************
     * @Method: Retorna o sistema operacional da máquina
     * que está acessando.
     * *************************************************/
    public function getOs() {
        if (isset($this->osTrue)) {
            return $this->setOS;
        } else {
            return " ";
        }
    }

    /** ************************************************
     * @Method: Retorna o navegador da máquina que está
     * acessando.
     * *************************************************/
    public function getBrowser() {
        if (isset($this->browserTrue)) {
            return $this->setBrowser;
        } else {
            return " ";
        }
    }

    /** ************************************************
     * @Method: Obtem o endereço de IP da máquina que
     * está acessando.
     * *************************************************/
    public function requestIP() {
        return $this->userIP;
    }
}
