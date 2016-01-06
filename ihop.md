# iHOP - Information Hyperlinked over Proteins #

For more information please read the paper:

  * A Gene Network for Navigating the Literature. Hoffmann, R., Valencia, A. Nature Genetics 36, 664 (2004)

Or visit the iHOP web sites

  * http://www.ihop-net.org/
  * http://ubio.bioinfo.cnio.es/biotools/iHOP/ (web services description)

# How to use iHOP through the Biological Web Services Proxy #

See the [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters)

## Examples ##

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getRelatedSymbols?gene=P53

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getSymbolsFromReference?reference=P38398

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/guessSymbolIdFromSymbolText?gene=P53&ncbiTaxId=10090

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getSymbolInfo?gene=P53&ncbiTaxId=9606

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getSymbolDefinitions?gene=BRCA1

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getSymbolInteractions?ihopid=32484

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getLatestSymbolInformation?gene=BRCA3&ncbiTaxId=9606

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getPubMed?pmid=15657137

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ihop&bwsp_response_format=raw&bwsp_url=http://ubio.bioinfo.cnio.es/biotools/iHOP/cgi-bin/getPubMed?ihoppmid=10533688