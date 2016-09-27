<?php
/**
 * @package: RRPProxyAPI
 * @link: https://github.com/feltkamptv/RRPProxyAPI
 * @developer: Feltkamp.tv Multimedia
 * @email: info@feltkamp.tv
 * @tel: +31 (0) 20 785 4487
 * @website: http://www.feltkamp.tv
 * @author: Pim Feltkamp
 * @copyright 2016 Pim Feltkamp
 * @license: http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note: This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
**/
class RRPProxy{
    protected $username = false;
    protected $password = false;
	
    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $api_key;
		$this->error = false;
		$this->soap_url = 'https://api-ote.rrpproxy.net:8082/soap';
    }// end function
	
	/** 
	* Check Domain Availability
	*
	* This function will check if a domain is available. 
	*
	* @param string $domain
	*
	* @return: array $appraisal
	**/
	public function CheckDomain($domain){
		$call_data = array('domain' => $domain);
		$data = $this->call('CheckDomain', $call_data);
		return $data;
	}// end function

	
	/** 
	* CALL
	*
	* This function will perform the SOAP API call.
	*
	* @param string $commmand
	* @param array $call_data
	* 
	* @return: array $result
	**/
	public function call($command, $call_data = array()){
		$this->error = false;
		$this->error_curl = false;
		
		$client = new SoapClient(NULL, array(
			"location" => $this->soap_url,
			"uri" => "urn:Api",
			"style" => SOAP_RPC,
			"use" => SOAP_ENCODED,
			));

		$params = array(
			array(
			"s_login" => $this->username,
			"s_pw" => $this->password,
			"s_opmode" => "OTE",
			"command" => $command
			)
		);
		
		foreach($call_data as $key => $val){
			$params[0][$key] = $val;
		}

		$result = $client->__call("xcall", $params, array("uri" => "urn:Api","soapaction" => "urn:Api#xcall"));
			
		if($result['code'] > 220){
			$this->error = 'Error code: '.$result['code'].'. '.$result['description'];
		}
		return $result;
	}// end function
	
	/** 
	* GET ERROR
	*
	* This function will return the error output.
	*
	* @return: string
	**/
	public function getError(){
		return $this->error;
	}// end function
}// end class
