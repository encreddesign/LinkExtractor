<?php

define("REQUEST_URL", "http://google.com/");
define("ANCHOR_TAG", "a");
define("ANCHOR_HREF_ATTR", "href");
define("LOCAL_FILE_NAME", "uris.txt");

$curlobj = curl_init();
$parser = new DOMDocument();

$url = null;
if($argv[1] != null){
	$url = $argv[1];
}else{
	$url = REQUEST_URL;
}

curl_setopt($curlobj, CURLOPT_URL, $url);
curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);

$html = null;

try{
	$html = curl_exec($curlobj);
	if($html == false){
		throw new Exception("No html data available.\n");
	}
}catch(Exception $ex){
	die("Error occured: ".$ex->getMessage());
	curl_close($curlobj);
}

if($html != null){
	echo "Crawling site... \n";
	$parser->loadHTML($html);
	
	$anchors = $parser->getElementsByTagName(ANCHOR_TAG);
	if($anchors->length > 0){
	
		echo "Getting urls... \n";
		$links = null;
		$Idx = 0;
		
		foreach($anchors as $anchor){
			
			$anchor_href = $anchor->hasAttribute(ANCHOR_HREF_ATTR) == true ? 
				$anchor->getAttribute(ANCHOR_HREF_ATTR) : "/null";

			if(substr($anchor_href, 0, strlen("http")) === "http"){
				$Idx++;
				echo $anchor_href.": RFWTLS(Anchor Idx ".$Idx.")\n";
				$links .= $anchor_href.PHP_EOL;
			}
		}
		if($links != null){
			writeToLocal(LOCAL_FILE_NAME, $links);
			curl_close($curlobj);
			exec('osascript -e \'display notification "Crawler finished extracting '.$Idx.' links." with title "PHPCrawler"\'');
			die("Finished extraction, with total of ".$Idx." extracted links\n");
		}
	}else{
		die("No URIS found.\n");
	}
}

function writeToLocal($name, $data){
	if($name != null){
		$uris = null;
		try{
			$uris = fopen($name, 'w');
			if(!$uris){
				throw new Exception("Unable to open new file named: ".$name);
			}
		}catch(Exception $ex){
			die("Error occured: ".$ex->getMessage());
		}
		if($uris != null){
			fwrite($uris, $data);
			fclose($uris);
		}else{
			die("File open has not been initialized.");
		}
	}else{
		die("File name has not been given.");
	}
}

?>