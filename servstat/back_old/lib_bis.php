<?
//param
$address = "217.118.227.34";
$port = 27015;
$RconPass= "";
$TimeOut="10";
//param


	class server{
		
		function EncapsCmd($cmd){
			$EncapsCmd = "\xFF\xFF\xFF\xFF".$cmd."\x00";
			return $EncapsCmd;
		}

		function GetChalange ($address,$port){
				$NumChalange="";
				$serverdatalen = 0;

				$cmd=new server;
				$EncapsCmd=$cmd->EncapsCmd("challenge rcon");

				$cssocket = fsockopen("udp://".$address,$port,$errnr);
				socket_set_blocking($cssocket,true);
				fputs($cssocket,$EncapsCmd,strlen($EncapsCmd));

				$parsing = new parsing;	
				$buffer = $parsing->net_get_int32($cssocket);
				$result = $parsing->net_get_word($cssocket);
				$result = explode(" ",trim($result));
				$result = $result[2];
				return $result;
				$NumChalange = eval(trim(substr ($NumChalange,strlen($cmd->EncapsCmd),strlen($NumChalange))));
				fclose($cssocket);
				
		}



		function SendCmd ($address,$port,$SendCmd){
			$result="";
			$serverdatalen = 0;

			$cmd=new server;
			$EncapsCmd=$cmd->EncapsCmd($SendCmd);

					$cssocket = fsockopen("udp://".$address,$port,$errnr);

					socket_set_blocking($cssocket,true);
					fputs($cssocket,$EncapsCmd,strlen($EncapsCmd));

						switch ($SendCmd){
						case "info":
							$parsing = new parsing;	
							$buffer = $parsing->net_get_int32($cssocket);
							$buffer = $parsing->net_get_byte($cssocket);
							$result["netaddress"] = trim($parsing->net_get_word($cssocket));
							$result["nameofthehost"] = trim($parsing->net_get_word($cssocket));
							$result["nameofthemap"] = trim($parsing->net_get_word($cssocket));
							$result["gamedirectory"] = trim($parsing->net_get_word($cssocket));
							$result["gamedescription"] = trim($parsing->net_get_word($cssocket));
							$result["activeclientcount"] = trim($parsing->net_get_byte($cssocket));
							$result["maximumclientsallowed"] = trim($parsing->net_get_byte($cssocket));
							$result["protocolversion"] = trim($parsing->net_get_byte($cssocket));
						break;

						case "players":
							$parsing = new parsing;	

							$buffer = $parsing->net_get_int32($cssocket);
							$buffer = $parsing->net_get_byte($cssocket);
							$count = $parsing->net_get_byte($cssocket);

								for($i = 0; $i < $count; $i++){
									$result[$i]["clientnumber"] = trim($parsing->net_get_byte($cssocket));
									$result[$i]["playername"] = trim($parsing->net_get_word($cssocket));
									$result[$i]["clientfragtotal"] = trim($parsing->net_get_int32($cssocket));
									$result[$i]["clienttotaltimein-game"] = date('H:i:s', round($parsing->net_get_float32($cssocket),0)+82800);
								}
						break;

						case "rules":
							$parsing = new parsing;	

							$buffer = $parsing->net_get_int32($cssocket);
							$buffer = $parsing->net_get_byte($cssocket);
							$count = $parsing->net_get_int16($cssocket);

								for($i = 0; $i < $count; $i++){
									$result[$i]["rulename"] = trim($parsing->net_get_word($cssocket));
									$result[$i]["rulevalue"] = trim($parsing->net_get_word($cssocket));
								}
						break;

						case "details":
							$parsing = new parsing;	

							$buffer = $parsing->net_get_int32($cssocket);
							$buffer = $parsing->net_get_byte($cssocket);
							$result["netaddress"] = trim($parsing->net_get_word($cssocket));
							$result["nameofthehost"] = trim($parsing->net_get_word($cssocket));
							$result["nameofthe map"] = trim($parsing->net_get_word($cssocket));
							$result["gamedirectory"] = trim($parsing->net_get_word($cssocket));
							$result["gamedescription"] = trim($parsing->net_get_word($cssocket));
							$result["activeclientcount"] = trim($parsing->net_get_byte($cssocket));
							$result["maximumclientsallowed"] = trim($parsing->net_get_byte($cssocket));
							$result["protocolversion"] = trim($parsing->net_get_byte($cssocket));
							$result["typeofserver"] = trim($parsing->net_get_byte($cssocket));
							$result["osofserver"] = trim($parsing->net_get_byte($cssocket));
							$result["passwordonserver"] = trim($parsing->net_get_byte($cssocket));
							$mod = $parsing->net_get_byte($cssocket);
							$result["runningamod"] = trim($mod);
							

								if($mod == 1){
									$result["urlformodwebsite"] = trim($parsing->net_get_word($cssocket));
									$result["urlformodftpserver"] = trim($parsing->net_get_word($cssocket));
									$result["modversion"] = trim($parsing->net_get_int32($cssocket));
									$result["moddownloadsize"] = trim($parsing->net_get_int32($cssocket));
									$result["modaserverside"] = trim($parsing->net_get_byte($cssocket));
									$result["thisserverrequirecustomclient"] = trim($parsing->net_get_byte($cssocket));
								}
						break;
						}
					fclose($cssocket);
				return $result;

		}

		function SendRconCmd ($address,$port,$RconPass,$SendRconCmd){
			$result = "erreur";
			$serverdatalen = 0;

			$cmd = new server;
			$rconChalange=$cmd->GetChalange($address,$port);
				if ($rconChalange != ""){
					$SendCmd=$cmd->EncapsCmd("rcon ".$rconChalange." ".$RconPass." ".$SendRconCmd);

					$cssocket = fsockopen("udp://".$address,$port,$errnr);
						
					socket_set_blocking($cssocket,true);
					fputs($cssocket,$SendCmd,strlen($SendCmd));
				
					$parsing = new parsing;	
					$buffer = $parsing->net_get_int32 ($cssocket);
					$result = $parsing->net_get_word ($cssocket);
					$result = substr($result, 1);

					fclose($cssocket);

				}
			return $result;

		}
	}




class parsing {

	function net_get_float32 ($fp){
		$buffer = unpack('fint',fread ($fp, 4));
		return $buffer[int];
	} 

	function net_get_int32 ($fp){
		$buffer = ord(fread ($fp, 1));
		$buffer += ord(fread ($fp, 1)) << 8;
		$buffer += ord(fread ($fp, 1)) << 16;
		$buffer += ord(fread ($fp, 1)) << 24;
		return $buffer;
	} 

	function net_get_word ($fp){
		$buffer= "";
		$byte = "\xff";
			while ($byte != "\x00"){
				$byte = fread ($fp, 1);
				$buffer .= $byte;
			}
		$this->result = $buffer;
		return $buffer;
	}

	function net_get_byte ($fp){
		$buffer = fread ($fp, 1);
		return ord($buffer);
	} 
	function net_get_int16 ($fp){
		$buffer = ord(fread ($fp, 1));
		$buffer += ord(fread ($fp, 1)) << 8;

		return $buffer;
	} 

}
?>