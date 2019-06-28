<?php

class PDO2 extends PDO {

	private static $_instance;
	private static $_write_prepared;

	public function __construct( ) {

	}

	public static function getInstance($dsn, $user, $pass) {

		//if (!isset(self::$_instance)) {
			
			self::$_instance = new PDO($dsn, $user, $pass);
			
			$res_charset = self::$_instance->prepare('SET CHARACTER SET "utf8"');
			$res_charset->execute();
			
			// KEMPF : Ajout de l'IP dans les LOGS
			self::$_write_prepared = self::$_instance->prepare("INSERT INTO aeroport_logs_sql VALUES('', NOW(), :sql, :ip)");
		//}
		
		return self::$_instance; 
	}
	
	
	public static function getWritePrepared() {
		return self::$_write_prepared;
	}
}

?>