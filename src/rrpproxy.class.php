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
    protected $ote = false;
	protected $cookiepath = false;
	
    public function __construct($username, $password, $ote = false, $cookiepath = false){
        $this->username = $username;
        $this->password = $password;
		$this->error = false;
		$this->ote = $ote;
		$this->cookiepath = $cookiepath;
		if(!$this->cookiepath){
			$this->cookiepath = '/home/'.get_current_user().'/cookies';
		}
		if($ote){
			$this->api_url = 'https://api-ote.rrpproxy.net/api/call?s_opmode=OTE&s_login='.$this->username.'&s_pw='.$this->password;
		}else{
			$this->api_url = 'https://api.rrpproxy.net/api/call?s_login='.$this->username.'&s_pw='.$this->password;
		}
    }// end function
	
	/** 
	* Check Domain Availability
	*
	* This function will check if a domain is available. 
	*
	* @param string/array $domain
	*
	* @return: array $data
	**/
	public function CheckDomain($domain){
		if(is_array($domain)){
			$call_data = array();
			for($i=0;$i<count($domain);$i++){
				$call_data['domain'.$i] = $domain[$i];
			}
		}else{
			$call_data = array('domain' => $domain);
		}
		$data = $this->call('CheckDomain', $call_data);
		return $data;
	}// end function
	
	/** 
	* Register Domain
	*
	* This function will register a domain. 
	*
	* @param string $domain
	* @param array $domain_data
	* @param int $period
	*
	* @return: array $data
	**/
	public function AddDomain($domain, $domain_data, $period = 1){
		$call_data = array('domain' => $domain, 'period' => $period);
		foreach($domain_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('AddDomain', $call_data);
		return $data;
	}// end function
	
	/** 
	* Modify Domain
	*
	* This function will modify domain settings. 
	*
	* @param string $domain
	* @param array $domain_data
	*
	* @return: array $data
	**/
	public function ModifyDomain($domain, $domain_data){
		$call_data = array('domain' => $domain);
		foreach($domain_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('ModifyDomain', $call_data);
		return $data;
	}// end function
	
	
	/** 
	* Status Domain
	*
	* This function will get the current status of the domain. 
	*
	* @param string $domain
	*
	* @return: array $data
	**/
	public function StatusDomain($domain){
		$call_data = array('domain' => $domain);
		$data = $this->call('StatusDomain', $call_data);
		return $data;
	}// end function
	
	
	/** 
	* Set Authcode
	*
	* This function will set the auth token for .eu, .be, .de, .no, .sg domains. 
	*
	* @param string $domain
	* @param array $domain_data
	*
	* @return: array $data
	**/
	public function SetAuthcode($domain, $request_data){
		$call_data = array('domain' => $domain);
		foreach($request_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('SetAuthcode', $call_data);
		return $data;
	}// end function
	
	/** 
	* Delete Domain
	*
	* This function will delete the domain. 
	*
	* @param string $domain
	*
	* @return: array $data
	**/
	public function DeleteDomain($domain){
		$call_data = array('domain' => $domain);
		$data = $this->call('DeleteDomain', $call_data);
		return $data;
	}// end function
	/** 
	* Renew Domain
	*
	* This function will renew a domain. 
	*
	* @param string $domain
	* @param array $domain_data
	*
	* @return: array $data
	**/
	public function RenewDomain($domain, $domain_data){
		$call_data = array('domain' => $domain);
		foreach($domain_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('RenewDomain', $call_data);
		return $data;
	}// end function
	
	/** 
	* Add Nameserver
	*
	* This function will add a nameserver. 
	*
	* @param string $nameserver
	*
	* @return: array $data
	**/
	public function AddNameserver($nameserver){
		$call_data = array('nameserver'=>$nameserver);
		$data = $this->call('AddNameserver', $call_data);
		return $data;
	}// end function
	
	/** 
	* Delete Nameserver
	*
	* This function will delete a nameserver. 
	*
	* @param string $nameserver
	*
	* @return: array $data
	**/
	public function DeleteNameserver($nameserver, $force = 1){
		$call_data = array('nameserver'=>$nameserver, 'force'=>$force);
		$data = $this->call('DeleteNameserver', $call_data);
		return $data;
	}// end function
	
	/** 
	* Add Contact
	*
	* This function will add a contact. 
	*
	* @param array $contact_data
	*
	* @return: array $data
	**/
	public function AddContact($contact_data){
		$call_data = array();
		foreach($contact_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('AddContact', $call_data);
		return $data;
	}// end function
	
	/** 
	* Query Contact List
	*
	* This function will search for contacts. 
	*
	* @param array $contact_data
	*
	* @return: array $data
	**/
	public function QueryContactList($contact_data){
		$call_data = array();
		foreach($contact_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('QueryContactList', $call_data);
		return $data;
	}// end function

	
	
	/** 
	* Add DNS Zone
	*
	* This function will a DNS zone. 
	*
	* @param string $zone
	* @param array $zone_datah
	*
	* @return: array $data
	**/
	public function AddDNSZone($zone, $zone_data){
		$call_data = array('DNSZONE'=>$zone);
		foreach($zone_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('AddDNSZone', $call_data);
		return $data;
	}// end function
	
	/** 
	* Query DNS Zone RR List
	*
	* This function will get the DNS record list. 
	*
	* @param string $zone
	* @param array $zone_data
	*
	* @return: array $data
	**/
	public function QueryDNSZoneRRList($zone, $zone_data){
		$call_data = array('DNSZONE'=>$zone);
		foreach($zone_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('QueryDNSZoneRRList', $call_data);
		return $data;
	}// end function
	
	
	
	/** 
	* Modify DNS Zone
	*
	* This function will modify the DNS Zone. 
	*
	* @param string $zone
	* @param array $zone_data
	*
	* @return: array $data
	**/
	public function ModifyDNSZone($zone, $zone_data){
		$call_data = array('DNSZONE'=>$zone);
		foreach($zone_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('ModifyDNSZone', $call_data);
		return $data;
	}// end function
	
	
	/** 
	* Delete DNS Zone
	*
	* This function will delete the DNS Zone. 
	*
	* @param string $zone
	* @param array $zone_data
	*
	* @return: array $data
	**/
	public function DeleteDNSZone($zone, $zone_data = array()){
		$call_data = array('DNSZONE'=>$zone);
		foreach($zone_data as $key => $val){
			$call_data[$key] = $val;
		}
		$data = $this->call('DeleteDNSZone', $call_data);
		return $data;
	}// end function
	
	/** 
	* CALL
	*
	* This function will perform the API call with Curl.
	*
	* @param string $command
	* @param array $call_data (optional)
	* 
	* @return: string $response
	**/
	public function call($command, $call_data = array()){
		$this->error = false;
		$this->error_curl = false;
		
		$url = $this->api_url.'&command='.$command;
		foreach($call_data as $key => $val){
			$url .= '&'.$key.'='.urlencode($val);
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiepath);
   		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiepath);
    	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
		
		$response = curl_exec($ch);
		if(!$response){
			$this->error_curl = curl_error($ch);
		}// no response
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($http_code == 200){
			$this->retry = false;
			return $this->resultToArray($response);
		}elseif(empty($http_code) && !$this->retry){
			$this->retry = true;
			sleep(500000);
			return $this->call($command, $call_data);
		}else{
			$this->retry = false;
			$this->httpcode = $http_code;
			$this->error = $response;
			return false;
		}// httpcode
	}// end function
	
	/** 
	* Result to array
	*
	* This function will return the result as an array.
	*
	* @param string $data
	*
	* @return: string
	**/
	public function resultToArray($data){
		$data = str_replace(array('[RESPONSE]', 'EOF'), array('', ''), $data);
		$new_data = '';
		$lines = explode('<br />', nl2br($data));
		foreach($lines as $line){
			if(trim($line) != ''){
				if(substr(trim($line), 0, 9) == 'property['){
					$new_data .= str_replace('property[', '', $this->str_replace_first(']', '', trim($line)))."\n";
				}else{
					$new_data .= trim($line)."\n";
				}
			}
		}
		$result = parse_ini_string($new_data);
		return $result;
	}// end function
	
	/** 
	* Replace first char occurence
	*
	* This function will replace the first occurence of a char. 
	*
	* @param string $from
	* @param string $to
	* @param string $subject
	*
	* @return: string
	**/
	public function str_replace_first($from, $to, $subject){
		$from = '/'.preg_quote($from, '/').'/';
		return preg_replace($from, $to, $subject, 1);
	}

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
