<?php
	/*
		PsychoQuery PHP Class

		The PsychoQuery PHP class provides an HLDS server interface for users to view the status of their server
		and to issue RCON/administrative commands

		RCON COMMANDS for edification purposes only ...
		banid <minutes> <uniqueid> [kick]	// bans and optionally kicks the userID
		removeid <uniqueid>			// unban a user
		changelevel <map>			// changes the map
		changelevel2 <map>			// continues the current game on a new map ?? Not sure about this one
		cvarlist
		dropclient				// drops a client ??
		exec <file.cfg>				// executes the config file
		hostname <name of server>		// name of server as it appears to players
		hostport <port>				// sets the connection port
		kick <player name>			// kicks the player matching <name>
		kick # <key>
		kick # <userid>
		killserver
		listid					// lists all banned IDs
		listip					// lists all banned IPs
		log <on/off>				// toggles logging
		logaddress <ip> <port>			// log data will stream to the IP port given
		maxplayers <#>
		motd_display_time <seconds>
		password <password>
		ping
		port <port>
		quit					// exits the server
	*/

if (defined("CLASS_PQUERY_PHP")) return 1;
define("CLASS_PQUERY_PHP", 1);

class PQ {
  var $DEBUG = 0;
  var $sock = NULL;
  var $errstr = '';
  var $raw = '';		// raw response data from last command sent
  var $timeout = 5;		// socket timeout value
  var $ipaddr = '';
  var $rconpass = '';

  function PQ($ip=NULL, $timeout=3) {
    if ($ip) $this->ipaddr = $ip;
    if ($timeout < 0) $timeout = 5;
    $this->timeout = $timeout;
  }

  function queryall($ip=NULL) {
    if (!$ip) $ip = $this->ipaddr;
    if (!$ip) return array();
    $info = $rules = $plrs = array();
    $info = $this->queryinfo($ip);
    if ($info) $rules = $this->queryrules($ip); 
    if ($rules) $plrs = $this->queryplayers($ip);
    $data = array();
    if ($info) $data += $info;
    if ($rules) $data += $rules;
    if ($plrs) $data += $plrs;
    return $data;
  }

  // returns the basic INFO from a server
  function queryinfo($ip=NULL) {
    if (!$ip) $ip = $this->ipaddr;
    if (!$ip) return FALSE;
    $res = $this->_sendquery($ip, 'details');
    $data = array();
    if (!empty($this->raw)) {
      $this->raw = substr($this->raw, 5);			// strip off '....m'
      $data['ipport'] 			= $this->_getnullstr();
      list($data['ip'], $data['port']) 	= explode(':', $data['ipport']);
      $data['name'] 			= $this->_getnullstr();
      $data['map'] 			= $this->_getnullstr();
      $data['gamedir'] 			= $this->_getnullstr();
      $data['gamename'] 		= $this->_getnullstr();
      $data['totalplayers']		= $this->_getbyte();
      $data['maxplayers']		= $this->_getbyte();
      $data['protocol']			= $this->_getbyte();
      $data['servertype']		= $this->_getchar();
      $data['serveros']			= $this->_getchar();
      $data['serverlocked']		= $this->_getbyte();
      $data['modrunning']		= $this->_getbyte();
      $data['modurl']			= $data['modrunning'] ? $this->_getnullstr() : '';
      $data['modftp']			= $data['modrunning'] ? $this->_getnullstr() : '';
      $this->_getnullstr(); // this null string is not used (depreciated) ... but it has to be stripped out.
      list($i1,$i2,$i3,$i4) 		= array($this->_getbyte(),$this->_getbyte(),$this->_getbyte(),$this->_getbyte());
      $data['modver']			= ( $i1 | ($i2 << 8) ) . '.' . ( $i3 | ($i4 << 8) );
      list($i1,$i2,$i3,$i4) 		= array($this->_getbyte(),$this->_getbyte(),$this->_getbyte(),$this->_getbyte());
      $data['modsize']			= ($i1) | ($i2 << 8) | ($i3 << 16) | ($i4 << 24);
      $data['modserveronly']		= $this->_getbyte();
      $data['modclientdll']		= $this->_getbyte();
    }
    return $data ? $data : FALSE;
  }

  // returns the RULES listing from a server
  function queryrules($ip=NULL) {
    if (!$ip) $ip = $this->ipaddr;
    if (!$ip) return FALSE;
    $res = $this->_sendquery($ip, 'rules');
    $data = array();
    if (!empty($this->raw)) {
      $this->raw = substr($this->raw, 5);                       // strip off '....E'
      $data['totalrules'] = ($this->_getbyte() | ($this->_getbyte() << 8)) - 1;
      $data['rules'] = array();
      for ($i=1; $i <= $data['totalrules']; $i++) {
        $data['rules'][ trim($this->_getnullstr()) ] = trim($this->_getnullstr());
      }
    }
    return $data;
  }

  // returns the PLAYERS listing from a server
  function queryplayers($ip=NULL) {
    if (!$ip) $ip = $this->ipaddr;
    if (!$ip) return FALSE;
    $res = $this->_sendquery($ip, 'players');
    $data = array();
    if (!empty($this->raw)) {
      $this->raw = substr($this->raw, 5);                       // strip off '....D'
      $data['activeplayers'] = $this->_getbyte();
      $data['players'] = array();
      for ($i=1; $i <= $data['activeplayers']; $i++) {
        $plr = array();
        $plr['id'] 		= $this->_getbyte();
        $plr['name']		= $this->_getnullstr();
        list($i1,$i2,$i3,$i4)	= array($this->_getbyte(),$this->_getbyte(),$this->_getbyte(),$this->_getbyte());
        $plr['kills']		= sprintf("%d", (($i1) | (($i2) << 8) | (($i3) << 16) | (($i4) << 24)));
        $f = @unpack("f1time", $this->raw);
        $this->raw = substr($this->raw, 4);
        $plr['onlinetime']	= (int) $f['time'];
        $data['players'][] 	= $plr;
      }
    }
    return $data;
  }

  // returns the ping of the server in ms
  function pingserver($ip=NULL) {
    if (!$ip) $ip = $this->ipaddr;
    if (!$ip) return FALSE;
    $start = $this->_getmicrotime();
    $res = $this->_sendquery($ip, 'ping');
    $end = $this->_getmicrotime();
    if (preg_match('/^....j/', $this->raw)) {
      return ($end - $start) * 1000;
    } else {
      return FALSE;				// server did not respond, or did not respond properly
    }
  }

  function set_rcon_password($pw) {
    $this->rconpass = $pw;
  }

  // Sends an RCON command to the server and returns the raw result
  function rcon($cmd, $password=NULL, $ip=NULL) {
    if (!$ip) $ip = $this->ipaddr;
    if (!$ip) return FALSE;
    if (empty($password)) $password = $this->rconpass;
    if (!$this->rconchallenge) {
      $res = $this->_sendquery($ip, "challenge rcon\n");
      if (preg_match('/^....challenge rcon (\\d+)/', $this->raw, $m)) {
        $this->rconchallenge = $m[1];
      }

      $this->_sendquery($ip, sprintf("rcon %s \"%s\" %s", $this->rconchallenge, $password, $cmd));
      if ($output = preg_replace('/^....l/', '', $this->raw)) {
        // insert custom 'formatting' logic here .... someday
        return $output;
      } else {
        return FALSE;
      }
    }
  }

  // sets the timeout value on the current socket, takes into account the newer PHP timeout function if it's present
  function _set_timeout($seconds=5, $micro=0) {
    if (function_exists('stream_set_timeout')) {		// PHP >= 4.3.0
      stream_set_timeout($this->sock, $seconds, $micro);
    } elseif (function_exists('socket_set_timeout')) {		// this function is deprecated
      socket_set_timeout($this->sock, $seconds);
    }
  }

  // internal function to send a non-authoritative query to a halflife server (NOT RCON COMMANDS)
  function _sendquery($ipport, $cmd) {
    list($ip,$port) = explode(':', $ipport);
    if (!$port) $port = '27015';
    $retry = 0;
    $maxretries = 2;

    $oldmqr = get_magic_quotes_runtime();

    if ($this->DEBUG) print "DEBUG: Opening socket to $ip:$port ...<br>\n";
    $this->sock = fsockopen("udp://$ip", $port, $this->errno, $this->errstr);
    $this->_set_timeout($this->timeout);

    $packets = array();					// stores each packet seperately, so we can combine them afterwards
    $command = pack("N", 0xFFFFFFFF) . $cmd . pack('x');
    $this->raw = "";

    if ($oldmqr) set_magic_quotes_runtime(0);
    if ($this->DEBUG) print "DEBUG: Sending '$cmd' to $ip:$port ...<br>\n";
    fwrite($this->sock, $command, strlen($command));

    $expected = 0;						// # of packets we're expecting
    do {
      $packet = fread($this->sock, 1500);
      if (strlen($packet) == 0) {
        $retry++;
        if ($this->DEBUG) print "DEBUG: Sending '$cmd' to $ip:$port ...<br>\n";
        fwrite($this->sock, $command, strlen($command));
        continue;
      }

      if ($this->DEBUG) print "DEBUG: Received " . strlen($packet) . " bytes from $ip:$port ...<br>$packet<br>\n";

      $header = substr($packet, 0, 4);				// get the 4 byte header
      $ack = @unpack("N1split", $header);

      $split = sprintf("%u", $ack['split']);
      if ($this->DEBUG) print "DEBUG: ACK = " . sprintf("%x", $ack['split']) . "<br>";
      if ($split == 0xFeFFFFFF) {				// we need to deal with multiple packets
        $packet = substr($packet, 4);				// strip off the leading 4 bytes
        $header = substr($packet, 0, 5);			// get the 'sub-header ack'
        $packet = substr($packet, 5);				// strip off 32bit int ID, seq# and total packet#
        $info = @unpack("N1id/C1byte", $header);			// we don't really care about the ID
        if ($this->DEBUG) printf("DEBUG: Sub ACK: %x (%08b)<br>\n", $info['byte'], $info['byte']);
        if (!$expected) $expected = $info['byte'] & 0x0F;	// now we know how many packets to receive
        $seq = (int)($info['byte'] >> 4);			// get the sequence number of this packet
        $packets[$seq] = $packet;				// store the packet
        $expected--;

      } elseif ($split == 0xFFFFFFFF) {				// we're dealing with a single packet
        $packets[0] = $packet;
        $expected = 0;
      }

    } while ($expected and $retry < $maxretries);

    fclose($this->sock);

    if ($oldmqr) set_magic_quotes_runtime(1);

//    print_r($packets); print "<br>";
    ksort($packets, SORT_NUMERIC);
    $this->raw = implode('', $packets);				// glue the packets together to make our final data string
    return 1;
  }

  function _getnullstr() {
    if (empty($this->raw)) return '';
    $end = strpos($this->raw, "\0");			// find position of first null byte
    $str = substr($this->raw, 0, $end);			// extract the string (not including null byte)
    $this->raw = substr($this->raw, $end+1);		// remove the extracted string (including null byte)
    return $str;					// return our str (no null byte)
  }

  function _getchar() {
    return sprintf("%c", $this->_getbyte());
  }

  function _getbyte() {
    if (empty($this->raw)) return '';
    $byte = substr($this->raw, 0, 1);
    $this->raw = substr($this->raw, 1);
    return ord($byte);
  }

  function _getmicrotime() { 
    list($usec, $sec) = explode(" ", microtime()); 
    return ((float)$usec + (float)$sec); 
  } 
}


?>
