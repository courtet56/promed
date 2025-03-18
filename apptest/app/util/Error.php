<?php

namespace app\util;

class Error {

	public static function checkModelArgs($arrVars, $cls, $tot): void {
		unset($arrVars['id']); //$id n'est pas un argument du constructeur, on retire
		$r=null;
		$defArgs = count($arrVars); //alternative : self::countProperties($cls)
		$curArgs = count($tot);
		if($defArgs !== $curArgs){$r=' <small>(<b>' . $curArgs . '</b> reçus)</small>';}
		foreach($arrVars as $k => $var) {
			if(empty($var)) {
				throw new \InvalidArgumentException(
					"Argument(s) vide(s) ou absent(s) pour le constructeur : " . 
					$cls . 
					" : Attention, il faut <b>" . 
					$defArgs .
					'</b> paramètres non vides pour ce constructeur !' . $r );
			}
		}
	}

	//@prototype
	private static function countProperties($cls): int {
		$reflection = new \ReflectionClass($cls);
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);
		return count($properties)-1; //$id n'est pas un argument du constructeur, on retire
	}

	public static function print(array $trace, int $wantedError=0): ?string {
		if (isset($trace[$wantedError])) {
			$firstTrace = $trace[$wantedError];
			$err = "<pre>";
			$err .= "Appelé dans : " . ($firstTrace['file'] ?? 'N/A') . " à la ligne " . ($firstTrace['line'] ?? 'N/A') . "\n";
			$err .= "Fonction : " . ($firstTrace['function'] ?? 'N/A') . "\n";
			$err .= "</pre>";
		}
		return $err;
	}

}
