LinkExtractor
=============

Link Extractor extracts links from a url using php. To use do the following:

<b>Note: </b>In order to use this, php is required to be intalled. This is only compatible with Mac.

Open up the terminal and navigate to the location of the crawler.php script. Then execute following command:
<code>
<pre>user/[location of crawler.php]>php crawler.php [url]</pre>
</code>

Once you press enter, link extractor will extract the links from the site and will show the links in the terminal:
<code>
<pre>/http://somelink.com/: RFWTLS(Anchor Idx 40)</pre>
<pre>Finished extraction, with total of 40 extracted links.</pre>
</code>
40 will be changed according to the amount of extracted links, once the extraction has finished, a apple notification will popup telling you it has finished.

<h3>RFWTLS</h3>
RFWTLS(Ready for writing to local system) tells you that the link extracted is ready to write to the system.
Once the extraction has finished, in the same folder as the script, there will be a text file called urls.txt which contains all extracted links.

In order to make sure this does not overwrite every time, rename the file for each extraction. At the moment this needs to be done manually.
